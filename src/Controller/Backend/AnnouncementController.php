<?php

namespace App\Controller\Backend;

use App\Entity\Adverts;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnouncementController extends Controller
{
    /**
     * @Route("/announcement", name="announcement")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $adverts = $this->getDoctrine()
            ->getRepository(Adverts::class)
            ->findAll();

        return $this->render('Backend/announcement/Announcement.html.twig', ['adverts' => $adverts]);
    }
}
