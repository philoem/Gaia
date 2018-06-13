<?php

namespace App\Controller\Backend;

use App\Entity\Adverts;
use App\Form\Admin\AdvertsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/adverts")
 */
class AdvertsController extends Controller
{
    /**
     * @Route("/", name="adverts_index", methods="GET")
     */
    public function index(): Response
    {
        $adverts = $this->getDoctrine()
            ->getRepository(Adverts::class)
            ->findAll();

        return $this->render('Backend/adverts/index.html.twig', ['adverts' => $adverts]);
    }

    /**
     * @Route("/new", name="adverts_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $advert = new Adverts();
        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('adverts_index');
        }

        return $this->render('Backend/adverts/new.html.twig', [
            'advert' => $advert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAdvert}", name="adverts_show", methods="GET")
     */
    public function show(Adverts $advert): Response
    {
        return $this->render('Backend/adverts/show.html.twig', ['advert' => $advert]);
    }

    /**
     * @Route("/{idAdvert}/edit", name="adverts_edit", methods="GET|POST")
     */
    public function edit(Request $request, Adverts $advert): Response
    {
        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adverts_edit', ['idAdvert' => $advert->getIdAdvert()]);
        }

        return $this->render('Backend/adverts/edit.html.twig', [
            'advert' => $advert,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAdvert}", name="adverts_delete", methods="DELETE")
     */
    public function delete(Request $request, Adverts $advert): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advert->getIdAdvert(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('adverts_index');
    }
}
