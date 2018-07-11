<?php

namespace App\Controller\Frontend;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function addMessageAction(Request $request, EntityManagerInterface $em, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
                             
        $form = $this->createForm(ContactType::class, $contact);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $em = $this->getDoctrine()->getManager();
                        
            $em->persist($contact);
            $em->flush();

            /* Ici envoi du message dans ma boîte mail */
            $contact->sendMail($mailer);

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé !'
            );
                       
            return $this->redirectToRoute('contact');
        
        }

        $formView = $form->createView();
        
        return $this->render('Frontend/contact/contact.html.twig', array('form'=>$formView));
        
    }
}
