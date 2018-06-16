<?php

namespace App\Controller\Frontend;

use App\Entity\Adverts;
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
    public function showTown(Request $request): Response
    {
        $advert = new Adverts();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT a.town, a.idAdvert FROM App\Entity\Adverts a');
        $adverts = $query->getResult();

        return $this->render('Frontend/Home.html.twig', ['adverts' => $adverts]);
    }


}