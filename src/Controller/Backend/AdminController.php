<?php

namespace App\Controller\Backend;

use App\Entity\Members;
use App\Form\AdminType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AdminController extends Controller
{
    /**
    * @Route("/admin", name="admin")
    * 
    */
    public function admin(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, Security $security) {

        $member = new Members();
        // Pré-remplissage des champs du formulaire
        $user = $security->getUser();
        $member->setLastname($user->getLastname());
        $member->setUsername($user->getUsername());
        $member->setMail($user->getMail());
        $member->setAddress($user->getAddress());

        $form = $this->createForm(AdminType::class, $member);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted()){

            $em = $this->getDoctrine()->getManager();
                        
            // Gestion du téléchargement de l'image
            //$file = $member->getImage();
            
            //$fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
            
            // moves the file to the directory where brochures are stored
            //$file->move(
            //    $this->getParameter('images_directory'),
            //    $fileName
            //);
            
            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            //$member->setImage($fileName);

            //$em->persist($member);
            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Sauvegarde effectuée !'
            );

            //return $this->redirect($this->generateUrl('admin'));
            return $this->redirectToRoute('admin', ['username' => $member->getUsername()]);
                
        }
        $formView = $form->createView();
        
        return $this->render('Backend/admin/Admin.html.twig', array('form'=>$formView, 'user' => $user, 'member' => $member));
    }

    
    /**
    * @Route("/admin/upload", name="admin_upload")
    * 
    */
    public function adminUpload(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, Security $security) {

        $member = new Members();
        
        $form = $this->createForm(AdminType::class, $member);
        
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        
        if($form->isSubmitted()){
            
            // Gestion du téléchargement de l'image
            $file = $member->getImage();
            
            $fileName = $this->md5(uniqid()).'.'.$file->guessExtension();
            
            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );
            
            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $member->setImage($fileName);

            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Sauvegarde effectuée !'
            );

            //return $this->redirect($this->generateUrl('admin'));
            return $this->redirectToRoute('admin', ['username' => $member->getUsername()]);
                
        }
        $formView = $form->createView();
        
        return $this->render('Backend/admin/Admin.html.twig', array('form'=>$formView, 'user' => $user, 'member' => $member));
    }
}
