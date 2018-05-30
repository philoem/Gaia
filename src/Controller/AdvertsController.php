<?php

namespace App\Controller;

use App\Entity\Adverts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdvertsController extends Controller
{
    /**
     * @Route("/adverts", name="adverts")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        return $this->render('Backend/adverts/Adverts.html.twig');
    }
}
