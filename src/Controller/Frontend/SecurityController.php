<?php

namespace App\Controller\Frontend;

use App\Entity\Members;
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
     * @Route("/login", name="security_login")
     */
     public function loginAction(Request $request, AuthenticationUtils $authenticationUtils)
     {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $member = new Members();
        $form = $this->createForm(LoginType::class, $member);
        $form->handleRequest($request);
        $formView2 = $form->createView();

        if($form->isSubmitted() && $form->isValid()){
            
            return $this->redirectToRoute('admin');
        } 
        return $this->render(
            'Frontend/login/Login.html.twig',
            array(
                'username' => $lastUsername,
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
        
        throw new \Exception('This should never be reached!');           

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logoutAction()
    {
        
        //throw new \Exception('This should never be reached!');
    }

    

    
}
