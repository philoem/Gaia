<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Members;

class HomeController extends Controller
{

    /**
     * 
     *@Route("/", name="home")
     * 
     */
    public function homepage()
    {
        return $this->render('home.html.twig');

    }

    
    

}