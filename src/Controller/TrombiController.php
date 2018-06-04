<?php

namespace App\Controller;

use App\Entity\Members;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrombiController extends Controller
{
    /**
     * @Route("/members", name="members")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $member = new Members();
        $active = $member->getIsActive();

        // Récupération des adresses dans la bdd
        $em = $this->getDoctrine()->getManager();
        $products = $this->getDoctrine()->getRepository(Members::class)->findAll();
        
       

        $username = json_encode($member->getUsername());
        $address = json_encode($member->getAddress());
            
        return $this->render('Backend/Trombi.html.twig', ['username' => $username, 'addresses' => $products]);
        
        
       
    }
}
