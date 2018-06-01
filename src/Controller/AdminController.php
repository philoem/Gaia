<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{
    /**
    * @Route("/admin", name="admin")
    */
    public function admin() {

        return $this->render('Backend/admin/Admin.html.twig');
    }
}
