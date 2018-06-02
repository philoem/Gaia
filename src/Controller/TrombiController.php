<?php

namespace App\Controller;

use App\Entity\Members;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrombiController extends Controller
{
    /**
     * @Route("/members", name="members")
     */
    public function index(Request $request)
    {
        $member = new Members();
        $active = $member->getIsActive();
        
       

            $username = $member->getUsername();
            $address = $member->getAddress();
            
            return $this->render('Backend/Trombi.html.twig', ['username' => $username]);
        
        
       
    }
}
