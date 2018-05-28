<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ListController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
     public function showAction(Request $request)
     {
         $characters = [
           'Daenerys Targaryen' => 'Emilia Clarke',
           'Jon Snow'           => 'Kit Harington',
           'Arya Stark'         => 'Maisie Williams',
           'Melisandre'         => 'Carice van Houten',
           'Khal Drogo'         => 'Jason Momoa',
           'Tyrion Lannister'   => 'Peter Dinklage',
           'Ramsay Bolton'      => 'Iwan Rheon',
           'Petyr Baelish'      => 'Aidan Gillen',
           'Brienne of Tarth'   => 'Gwendoline Christie',
           'Lord Varys'         => 'Conleth Hill'
         ];
 
         return $this->render('Backend/Admin.html.twig', array('character' => $characters));
     }
}
