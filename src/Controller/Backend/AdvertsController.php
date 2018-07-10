<?php

namespace App\Controller\Backend;

use App\Entity\Advert;
use App\Entity\Member;
use App\Entity\Comment;
use App\Service\ImageUploader;
use App\Form\Admin\AdvertsType;
use App\Form\Admin\CommentType;
use App\Repository\AdvertsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/adverts")
 */
class AdvertsController extends Controller
{
    /**
     * @Route("/", name="adverts_index", methods="GET")
     * 
     */
    public function index(EntityManagerInterface $em): Response
    {
        
        $user = $this->getUser();

        $adverts = $this->getDoctrine()
            ->getRepository(Advert::class)
            ->findBy([
                'member' => $user->getId(),
            ]);
        
        $commentList = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findall();
        
        return $this->render('Backend/adverts/index.html.twig', [
            'adverts'   => $adverts,
            'comments'  => $commentList,
            'user'      => $user
        ]);
    }

    /**
     * @Route("/new", name="adverts_new", methods="GET|POST")
     */
    public function new(Request $request, EntityManagerInterface $em, ImageUploader $imageUploader): Response
    {
        $advert = new Advert();
        $user = $this->getUser();
               
        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $advert->setMember($user);
            $advert->setUsernameMember($user->getUsername());
            
            // Gestion de l'image
            $file = $form['picturesAdverts']->getData();
            $fileName = $imageUploader->uploadAdvert($file);
            $advert->setPicturesAdverts($fileName);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($advert);
            $em->flush();

            return $this->redirectToRoute('adverts_index');
        }

        return $this->render('Backend/adverts/new.html.twig', [
            'advert'    => $advert,
            'form'      => $form->createView(),
        ]);
    }

    /**
     * @Route("/{idAdvert}", name="adverts_show", methods="GET")
     *
     */
    public function show(Advert $advert): Response
    {
        $userAdvert = $advert->getIdAdvert();
        $username = $advert->getUsernameMember();
        $user = $this->getUser();

        return $this->render('Backend/adverts/show.html.twig', [
            'advert'        => $advert,
            'userAdvert'    =>$userAdvert,
            'username'      => $username,
            'user'          => $user,
        ]);
    }
    

    /**
     * @Route("/{advert}/edit", name="adverts_edit", methods="GET|POST")
     * @ParamConverter("advert", class="App\Entity\Advert")
     */
    public function edit(Request $request, Advert $advert, ImageUploader $imageUploader): Response
    {

        $form = $this->createForm(AdvertsType::class, $advert);
        $form->handleRequest($request);

        // Ici récupération de l'image
        $file = $form['picturesAdverts']->getData();

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Gestion de l'image
            if ($file === null) {
                
                $advert->setPicturesAdverts($advert->getPicturesAdverts());
            
            } elseif ($file !== null) {

                $fileName = $imageUploader->uploadAdvert($file);
                $advert->setPicturesAdverts($fileName);
            }
                        
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('adverts_index');
        }

        return $this->render('Backend/adverts/edit.html.twig', [
            'advert'    => $advert,
            'form'      => $form->createView(),
            'username'  => $advert->getUsernameMember(),
        ]);
    }

    /**
     * @Route("/{idAdvert}", name="adverts_delete", methods="DELETE")
     */
    public function delete(Request $request, Advert $advert): Response
    {
        
        if ($this->isCsrfTokenValid('delete'.$advert->getIdAdvert(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($advert);
            $em->flush();
        }

        return $this->redirectToRoute('adverts_index', ['username' => $advert->getUsernameMember()]);
    }

    /**
    * @Route("/comment/advert/{id}", name="comment", methods="GET|POST", requirements={"id"="\d+"})
    * @ParamConverter("advert", class="App\Entity\Advert")
    * 
    */
    public function buttonComment(EntityManagerInterface $em, Request $request, Advert $advert)
    {
        $comment = new Comment();
        $username = $advert->getUsernameMember();
        
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $comment->setAdverts($advert);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé !'
            );
            
            return $this->render('Backend/comment/comment.html.twig', [
                'formComment' => $form->createView(),
                'comment'     => $comment,
                'username'    => $username,
            ]);
        }
        
        return $this->render('Backend/comment/comment.html.twig', [
            'formComment' => $form->createView(),
            'comment'     => $comment,
            'username'    => $username,
            'advert'      => $advert,
        ]);
    }

    /**
    * @Route("/comment/{id}", name="comment_reply", methods="GET|POST", requirements={"id"="\d+"})
    * @ParamConverter("comment", class="App\Entity\Comment")
    * 
    */
    public function replyComment(EntityManagerInterface $em, Request $request, Comment $comment)
    {
        
        $reply = new Comment();
        $username = $comment->getName();

        $form = $this->createForm(CommentType::class, $reply);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $reply->addCommentLinkedToAdvert($comment);

            $em = $this->getDoctrine()->getManager();
            $em->persist($reply);
            $em->flush();

            /* Ici affichage d'un message confirmant l'enregistrement du message */
            $this->addFlash(
                'notice',
                'Votre message a bien été envoyé !'
            );
            
            return $this->render('Backend/comment/comment.html.twig', [
                'formComment' => $form->createView(),
                'comment'     => $comment,
            ]);
        }
        
        return $this->render('Backend/comment/comment.html.twig', [
            'formComment' => $form->createView(),
            'comment'     => $comment,
            'username'    => $username,
        ]);
    }
    
    /**
    * @Route("/comment/delete/{id}", name="comment_delete", requirements={"id"="\d+"})
    * @ParamConverter("comment", class="App\Entity\Comment")
    */
    public function deleteComment(Comment $comment, EntityManagerInterface $em)
    {
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('adverts_index');
    }

}
