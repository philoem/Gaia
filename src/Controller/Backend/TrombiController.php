<?php

namespace App\Controller\Backend;

use App\Entity\Member;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
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
    public function index(Request $request, EntityManagerInterface $em, Security $security)
    {
        $member = new Member();
        $user = $security->getUser();
                   
        $em = $this->getDoctrine()->getManager();
        
        $query = $em->createQuery("SELECT u.id, u.username, u.lat, u.lng, a.title, a.idAdvert FROM App\Entity\Member u JOIN App\Entity\Advert a WHERE  u.isActive = true AND a.member = u.id");
        $users = $query->getResult();
        
        return $this->render('Backend/trombi.html.twig', ['addresses' => $users, 'adress' => $user]);
       
    }
}
