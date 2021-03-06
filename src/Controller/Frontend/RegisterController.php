<?php

namespace App\Controller\Frontend;

use App\Entity\Member;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    private $passwordEncoder;
    /**
    * @Route("/register", name="inscription")
    */
    public function addAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em)
    {
        $member = new Member();
                             
        $form = $this->createForm(RegisterType::class, $member);
        
        $form->handleRequest($request);
                
        $em = $this->getDoctrine()->getManager();
        if($form->isSubmitted() && $form->isValid()){
            
            $this->passwordEncoder = $passwordEncoder;
            
            $password = $passwordEncoder->encodePassword($member, $member->getPassword());
            $member->setPassword($password);
            
            $member->setRoles(['ROLE_ADMIN']);
                        
            $em->persist($member);
            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Votre inscription a bien été enregistrée !'
            );
            
                       
            return $this->redirectToRoute('inscription');
            
        }

        $formView = $form->createView();
        
        return $this->render('Frontend/register/registerAddMember.html.twig', array('form'=>$formView));

    }
    
}
