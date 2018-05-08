<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Members;
use App\Form\RegisterType;

class RegisterController extends Controller
{
    /**
     * @Route("/register", name="register")
     */
    //public function index()
    //{
    //    return $this->render('register/index.html.twig', [
    //        'controller_name' => 'RegisterController',
    //    ]);
    //}
    
    public function addAction(Request $request)
    {
        $member = new Members();

        $form = $this->createForm(RegisterType::class, $member);

        $formView = $form->createView();
        
        return $this->render('register/RegisterAddMember.html.twig', array('form'=>$formView));
  

        



    }
}
