<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function addMessageAction(Request $request, EntityManagerInterface $em)
    {
        $contact = new Contact();
                             
        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            
                        
            $em = $this->getDoctrine()->getManager();
                        
            $em->persist($contact);
            $em->flush();
            
                       
            
        
        }

        $formView = $form->createView();
        
        return $this->render('Frontend/Contact/Contact.html.twig', array('form'=>$formView));
        
    }
}
