<?php

namespace App\Controller\Backend;

use App\Entity\Advert;
use App\Entity\Member;
use App\Form\Admin\AdvertsType;
use App\Repository\AdvertsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/adverts")
 */
class AdvertsController extends Controller
{
    /**
     * @Route("/", name="adverts_index", methods="GET")
     */
    public function index(Security $security, EntityManagerInterface $em): Response
    {
        $user = $security->getUser();
        $adverts = $this->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([
                'member' => $user->getId()
            ]);
        
        return $this->render('Backend/adverts/index.html.twig', ['adverts' => $adverts]);
    }

    /**
     * @Route("/new", name="adverts_new", methods="GET|POST")
     */
    public function new(Request $request, Security $security): Response
    {
        $advert = new Advert();
        $user = $security->getUser();
               
        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
           
            $advert->setMember($user);
            $advert->setUsernameMember($user->getUsername());
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
    public function show(EntityManagerInterface $em, Advert $advert): Response
    {
        $userAdvert = $advert->getIdAdvert();
        $username = $advert->getUsernameMember();
        
        return $this->render('Backend/adverts/show.html.twig', ['advert' => $advert, 'userAdvert' =>$userAdvert, 'username' => $username]);
    }
    

    /**
     * @Route("/{advert}/edit", name="adverts_edit", methods="GET|POST")
     * @ParamConverter("advert", class="App\Entity\Advert")
     */
    public function edit(Request $request, Advert $advert): Response
    {
        $userAdvert = $advert->getIdAdvert();
        $username = $advert->getUsernameMember();

        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $advert = $form->getData();
            
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('adverts_index');
        }

        return $this->render('Backend/adverts/edit.html.twig', [
            'advert' => $advert,
            'form' => $form->createView(),
            'userAdvert' =>$userAdvert,
            'username' => $username
        ]);
    }

    /**
     * @Route("/{idAdvert}", name="adverts_delete", methods="DELETE")
     */
    public function delete(Request $request, Advert $advert): Response
    {
        $username = $advert->getUsernameMember();
        if ($this->isCsrfTokenValid('delete'.$advert->getIdAdvert(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('adverts_index', ['username' => $username]);
    }
}
