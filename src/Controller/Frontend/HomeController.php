<?php

namespace App\Controller\Frontend;

use App\Entity\Advert;
use Doctrine\ORM\EntityManagerInterface;
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
    public function showTown(Request $request, EntityManagerInterface $em): Response
    {
        $advert = new Advert();
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('SELECT a.town, a.idAdvert FROM App\Entity\Advert a');
        $adverts = $query->getResult();

        return $this->render('Frontend/home.html.twig', ['adverts' => $adverts]);
    }


}