<?php

namespace App\Controller;

use App\Entity\Members;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends Controller
{
    /**
     * 
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em)
    {
                
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/login.html.twig', array(
            'username_login' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
          ));
        
        //$member = new Members();
//
        //$form = $this->createForm(LoginType::class, $member);
        //$form->handleRequest($request);
   //
        //$formView = $form->createView();
        //return $this->render('login/Login.html.twig', array('form'=>$formView));
        //
        //$query = $em->createQuery(
        //    'SELECT a.username_login FROM App:Members a)'
        //);
        //$username_login = $query->getResult();
        //
        //if($form->isSubmitted() && $form->handleRequest($request)->isValid()){
        //    
        //    if($username_login === "ROLE_USER"){
        //        
        //        return $this->redirectToRoute('admin');
        //        
        //    } else {
        //        
        //        throw $this->createNotFoundException('Ce membre n\'existe pas !');
        //    }
        //}

             
  
    }

    /**
     * 
     *@Route("/dashboard", name="tableau_de_bord")
     * 
     */
    public function dashboard()
    {
        $member = new Members();
              
        $this->addFlash(
            'notice',
            'Bienvenu '.$member->getUsernameLogin()
        );
        
        return $this->render('Dashboard.html.twig');

    }
}
