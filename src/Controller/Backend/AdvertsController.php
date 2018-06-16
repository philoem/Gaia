<?php

namespace App\Controller\Backend;

use App\Entity\Adverts;
use App\Form\Admin\AdvertsType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/adverts")
 */
class AdvertsController extends Controller
{
    /**
     * @Route("/", name="adverts_index", methods="GET")
     */
    public function index(Security $security): Response
    {
        $user = $security->getUser()->getIdMember();
        $adverts = $this->getDoctrine()
            ->getRepository(Adverts::class)
            ->findBy([
                'idMember' => $user
            ]);
       
        return $this->render('Backend/adverts/index.html.twig', ['adverts' => $adverts]);
    }

    /**
     * @Route("/new", name="adverts_new", methods="GET|POST")
     */
    public function new(Request $request, Security $security): Response
    {
        $advert = new Adverts();
        $user = $security->getUser()->getIdMember();
        
        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Retourne l'id du membre dans le champs "idMember"
            $advert->setidMember($user);
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
        $userAdvert = $advert->getIdMember();
        
        return $this->render('Backend/adverts/show.html.twig', ['advert' => $advert, 'userAdvert' =>$userAdvert]);
    }
    

    /**
     * @Route("/{idAdvert}/edit", name="adverts_edit", methods="GET|POST")
     */
    public function edit(Request $request, Adverts $advert): Response
    {
        $userAdvert = $advert->getIdMember();
        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);
        dump($userAdvert);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adverts_edit', ['idAdvert' => $advert->getIdAdvert()]);
        }

        return $this->render('Backend/adverts/edit.html.twig', [
            'advert' => $advert,
            'form' => $form->createView(),
            'userAdvert' =>$userAdvert,
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
