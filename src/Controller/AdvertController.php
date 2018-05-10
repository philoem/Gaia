<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Members;

class AdvertController extends Controller
{

    /**
     * 
     *@Route("/", name="home")
     * 
     */
    public function homepage()
    {

        return new Response("Bienvenu sur le site");

    }

    /**
     * 
     *@Route("/advert/{id}", name="annonce", requirements={"id" = "\d+"})
     * 
     */
    public function advert($id, Request $request)
    {

        $tag = $request->query->get('tag');

        return $this->render('Advert.html.twig', array(
        'id'  => $id,
        'tag' => $tag,
        ));
       

    }
    
    

}