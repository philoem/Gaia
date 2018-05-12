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
   
        $em =$this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT a.pseudo FROM App:Members a'
        );
        $pseudo = $query->getResult();
        
        if($form->isSubmitted()){
            
            if($member->getUsername()){
                
                $this->addFlash(
                    'notice',
                    'Bienvenu '.$member->getUsername()
                );
                
                //return $this->redirectToRoute('home');
                
            } else {
                throw $this->createNotFoundException('Ce membre n\'existe pas !');
            }
        }

         

        $formView = $form->createView();
        
        return $this->render('login/Login.html.twig', array('form'=>$formView));
  
    }
}
