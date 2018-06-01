<?php

namespace App\Controller;

use App\Entity\Members;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
     public function showAction(Request $request)
     {
        

        return $this->render('Backend/Admin.html.twig');
     }
}
