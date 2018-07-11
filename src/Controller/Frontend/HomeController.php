<?php

namespace App\Controller\Frontend;

use App\Entity\Advert;
use Doctrine\ORM\EntityManagerInterface;
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
    public function showTown(): Response
    {
        
        $adverts = $this->getDoctrine()
            ->getRepository(Advert::class)
            ->findAllTown();

        return $this->render('Frontend/home.html.twig', ['adverts' => $adverts]);
    }


}