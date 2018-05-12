<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Members;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    private $passwordEncoder;
    /**
    * @Route("/register", name="inscription")
    */
    public function addAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $member = new Members();
        
        $form = $this->createForm(RegisterType::class, $member);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $this->passwordEncoder = $passwordEncoder;
            
            $em =$this->getDoctrine()->getManager();
            $member->setPassword($this->passwordEncoder->encodePassword($member, $member->getPassword()));
            $member->setRepeatPassword($this->passwordEncoder->encodePassword($member, $member->getRepeatPassword()));

            
            $em->persist($member);
            $em->flush();

            return new Response('Bienvenu '.$member->getUsername() .' dans la communauté Gaia, votre profil a bien été inscrit');

        }

        $formView = $form->createView();
        
        return $this->render('register/RegisterAddMember.html.twig', array('form'=>$formView));
  

    }
}
