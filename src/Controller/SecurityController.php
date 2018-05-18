<?php

namespace App\Controller;

use App\Entity\Login;
use App\Form\LoginType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
   /**
     * 
     *
     * 
     */
    //public function login(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em)
    //{
    //            
    //    $authenticationUtils = $this->get('security.authentication_utils');
    //    // get the login error if there is one
    //    $error = $authenticationUtils->getLastAuthenticationError();
    //    // last username entered by the user
    //    $lastUsername = $authenticationUtils->getLastUsername();
//
    //    //return $this->render('login/login.html.twig', array(
    //    //    'username_login' => $authenticationUtils->getLastUsername(),
    //    //    'error'         => $authenticationUtils->getLastAuthenticationError(),
    //    //  ));
    //    
    //    $member = new Members();
//
    //    $form = $this->createForm(LoginType::class, $member);
    //    $form->handleRequest($request);
   //
    //    
    //    
    //    //$query = $em->createQuery(
    //        //    'SELECT a.username_login FROM App:Members a)'
    //        //);
    //        //$username_login = $query->getResult();
    //        
    //    if($form->isSubmitted() && $form->isValid()){
    //        
    //        if($username_login === "ROLE_USER"){
    //            
    //            return $this->redirectToRoute('admin');
    //            
    //        } else {
    //            
    //            throw $this->createNotFoundException('Ce membre n\'existe pas !');
    //        }
    //    }
    //        
    //    $formView = $form->createView();
    //    return $this->render('login/Login.html.twig', array('form'=> $formView));             
  //
    //}

    /**
     * @Route("/login", name="security_login")
     */
     public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
     {
        //$helper = $this->get('security.authentication_utils');
        $lastUsername = $authenticationUtils->getLastUsername();
        $error = $authenticationUtils->getLastAuthenticationError();
        
        $login = new Login();
        $form = $this->createForm(LoginType::class, $login);
        $form->handleRequest($request);
        $formView2 = $form->createView();

        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('admin');
        } 
        return $this->render(
            'login/Login.html.twig',
            array(
                'username_login' => $lastUsername,
                'error'         => $error,
                'form'  =>$formView2
            )
        );
     }
 
    /**
     * @Route("/login_check", name="security_login_check")
     *
     *
     */
    public function loginCheckAction(Request $request)
    {
        return $this->render(
            'admin.html.twig');
        //throw new \Exception('This should never be reached!');           

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {

    }

    
}
