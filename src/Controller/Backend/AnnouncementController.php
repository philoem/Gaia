<?php

namespace App\Controller\Backend;

use App\Entity\Advert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnouncementController extends Controller
{
    /**
     * @Route("/announcement", name="announcement")
     */
    public function index()
    {
        return $this->render('Backend/announcement/announcement.html.twig', [
            'adverts' => $this->getDoctrine()
            ->getRepository(Advert::class)
            ->findAll()
        ]);
    }

}
