<?php

namespace App\Controller\Backend;

use App\Entity\Member;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class TrombiController extends Controller
{
    /**
     * @Route("/members", name="members")
     */
    public function index()
    {
         
        $users = $this->getDoctrine()
            ->getRepository(Member::class)
            ->findAllMemberActive();
        
        return $this->render('Backend/trombi.html.twig', [
            'addresses' => $users,
            'adress'    => $this->getUser(),
        ]);
       
    }
}
