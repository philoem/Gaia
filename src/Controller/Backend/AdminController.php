<?php

namespace App\Controller\Backend;

use App\Entity\Members;
use App\Form\Admin\AdminType;
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
    * @Route("/admin", name="admin_index")
    * 
    */
    public function admin(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em, Security $security) {

        // Pré-remplissage des champs du formulaire
        $user = $security->getUser();
        
        $form = $this->createForm(AdminType::class, $user);
        $form->handleRequest($request);
        
        dump($user);
        if($form->isSubmitted() && $form->isValid()){

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
        
        return $this->render('Backend/admin/Admin.html.twig', ['form'=>$formView, 'user' => $user]);
    }
        
}
