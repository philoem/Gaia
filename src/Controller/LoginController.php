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
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em)
    {
        
        $member = new Members();

        $form = $this->createForm(LoginType::class, $member);
        $form->handleRequest($request);
   
       
        $query = $em->createQuery(
            'SELECT a.username_login FROM App:Members a'
        );
        $pseudo = $query->getResult();
        
        if($form->isSubmitted()){
            
            if($member->getUsernameLogin()){
                
                               
                return $this->redirectToRoute('tableau_de_bord');
                
            } else {
                throw $this->createNotFoundException('Ce membre n\'existe pas !');
            }
        }

         

        $formView = $form->createView();
        
        return $this->render('login/Login.html.twig', array('form'=>$formView));
  
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
