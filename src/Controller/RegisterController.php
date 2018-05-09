<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Members;
use App\Form\RegisterType;

class RegisterController extends Controller
{
    /**
    * @Route("/register", name="register")
    */
    public function addAction(Request $request)
    {
        $member = new Members();

        $form = $this->createForm(RegisterType::class, $member);

        $form->handleRequest($request);

        if($form->isSubmitted()){

            $em =$this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            return new Response('Bienvenu dans la communauté Gaia, votre profil a bien été inscrit');

        }

        $formView = $form->createView();
        
        return $this->render('register/RegisterAddMember.html.twig', array('form'=>$formView));
  

        



    }
}
