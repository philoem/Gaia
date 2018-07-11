<?php

namespace App\Controller\Backend;

use App\Entity\Member;
use App\Form\Admin\AdminType;
use App\Service\ImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    
    /**
    * @Route("/admin", name="admin_index")
    * 
    */
    public function admin(Request $request, EntityManagerInterface $em, ImageUploader $imageUploader) {
        
        // Pré-remplissage des champs du formulaire
        $user = $this->getUser();
        
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);

        // Ici récupération de l'image
        $file = $form['imageName']->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Gestion de l'image
            if ($file === null) {
                
                $user->setImageName($user->getImageName());
            
            } elseif ($file !== null) {

                $fileName = $imageUploader->uploadProfil($file);
                $user->setImageName($fileName);
            }     
            
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Sauvegarde effectuée !'
            );
            
            return $this->redirectToRoute('admin_index', ['username' => $user->getUsername()]);
                
        }
        
        $formView = $form->createView();
        
        return $this->render('Backend/admin/admin.html.twig', [
            'form'  =>$formView,
            'user'  => $user
        ]);
    }
        
}
