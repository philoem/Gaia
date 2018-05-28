<?php

namespace App\Controller;

use App\Entity\Members;
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
        $member = new Members();
                             
        $form = $this->createForm(RegisterType::class, $member);
        
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $this->passwordEncoder = $passwordEncoder;
            
            $password = $passwordEncoder->encodePassword($member, $member->getPassword());
            $member->setPassword($password);

            $username = $member->getUsername();
                        
            $member->setRoles(['ROLE_ADMIN']);
                        
            $em = $this->getDoctrine()->getManager();
                        
            $em->persist($member);
            $em->flush();
            
                       
            return $this->redirectToRoute('security_login');
        
        }

        $formView = $form->createView();
        
        return $this->render('register/RegisterAddMember.html.twig', array('form'=>$formView));
  

    }
}
