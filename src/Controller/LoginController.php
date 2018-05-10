<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Members;
use App\Form\LoginType;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function index(Request $request)
    {
        $member = new Members();

        $form = $this->createForm(LoginType::class, $member);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em =$this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            //return new Response('Bienvenu dans la communauté Gaia, votre profil a bien été inscrit');

        }

        $formView = $form->createView();
        
        return $this->render('login/Login.html.twig', array('form'=>$formView));
  
    }
}
