<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MembersController extends Controller
{
    /**
     * @Route("/members", name="members")
     */
    public function index()
    {
        return $this->render('Backend/members/Members.html.twig');
    }
}
