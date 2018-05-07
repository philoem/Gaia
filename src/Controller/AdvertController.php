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
     *@Route("/")
     * 
     */
    public function homepage()
    {

        return new Response("Bienvenu sur le site");

    }

    /**
     * 
     *@Route("/{id}")
     * 
     */
    public function advert($id, Request $request)
    {

        $tag = $request->query->get('tag');

        return $this->render('Advert.html.twig', array(
        'id'  => $id,
        'tag' => $tag,
        ));
        if ($id == "test") {
            return $this->memberAction();
        }

    }
    /**
     * 
     *@Route("/add/test")
     * 
     */
    public function memberAction()
    {
        $member = new Members();
        $member->setIdMember(1)
            ->setFirstname('Philippe')
            ->setLastname('Cham')
            ->setPseudo('Philou')
            ->setMail('philoem@nexgate.ch')
            ->setPw('aze');
            
            
        $em = $this->getDoctrine()->getManager();
        $em->persist($member);
        $em->flush();

        return new Response('prénom créé avec : ' .$member->getFirstname());

    }



}