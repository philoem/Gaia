<?php

namespace App\Controller\Backend;

use App\Entity\Members;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class TrombiController extends Controller
{
    /**
     * @Route("/members", name="members")
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $member = new Members();

        // Récupération des adresses dans la bdd
        $em = $this->getDoctrine()->getManager();
        $products = $this->getDoctrine()->getManager()->getRepository(Members::class)->findAll();
        
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        
        $userAddress = $serializer->serialize($products, 'json');

        $Address = 'json/Address.json';
        $Addresse = fopen($Address, "w+");
        fwrite($Addresse, $userAddress);
        fclose($Addresse);
            
        return $this->render('Backend/Trombi.html.twig', ['addresses' => $products, $userAddress]);
        
        
       
    }
}
