<?php

namespace App\Controller;

use App\Entity\Members;
use App\Form\MembersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/members")
 */
class MembersController extends Controller
{
    /**
     * @Route("/", name="members_index", methods="GET")
     */
    public function index(): Response
    {
        $members = $this->getDoctrine()
            ->getRepository(Members::class)
            ->findAll();

        return $this->render('Backend/members/index.html.twig', ['members' => $members]);
    }

    /**
     * @Route("/new", name="members_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $member = new Members();
        $form = $this->createForm(MembersType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            return $this->redirectToRoute('members_index');
        }

        return $this->render('Backend/members/new.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMember}", name="members_show", methods="GET")
     */
    public function show(Members $member): Response
    {
        return $this->render('Backend/members/show.html.twig', ['member' => $member]);
    }

    /**
     * @Route("/{idMember}/edit", name="members_edit", methods="GET|POST")
     */
    public function edit(Request $request, Members $member): Response
    {
        $form = $this->createForm(MembersType::class, $member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('members_edit', ['idMember' => $member->getIdMember()]);
        }

        return $this->render('Backend/members/edit.html.twig', [
            'member' => $member,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idMember}", name="members_delete", methods="DELETE")
     */
    public function delete(Request $request, Members $member): Response
    {
        if ($this->isCsrfTokenValid('delete'.$member->getIdMember(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($member);
            $em->flush();
        }

        return $this->redirectToRoute('members_index');
    }
}
