<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{

    /**
     * 
     * @Route("/", name="home")
     * 
     */
    public function homepage()
    {
        return $this->render('Frontend/Home.html.twig');

    }


}