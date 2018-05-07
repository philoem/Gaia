<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comments
 *
 * @ORM\Table(name="comments", indexes={@ORM\Index(name="FK_comments_id_advert", columns={"id_advert"})})
 * @ORM\Entity
 */
class Comments
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_comment", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idComment;

    /**
     * @var string
     *
     * @ORM\Column(name="name_comments", type="string", length=60, nullable=false)
     */
    private $nameComments;

    /**
     * @var string
     *
     * @ORM\Column(name="commentary", type="string", length=255, nullable=false)
     */
    private $commentary;

    /**
     * @var \Adverts
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Adverts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_advert", referencedColumnName="id_advert")
     * })
     */
    private $idAdvert;



    /**
     * Get the value of idComment
     *
     * @return  int
     */ 
    public function getIdComment()
    {
        return $this->idComment;
    }

    /**
     * Set the value of idComment
     *
     * @param  int  $idComment
     *
     * @return  self
     */ 
    public function setIdComment(int $idComment)
    {
        $this->idComment = $idComment;

        return $this;
    }

    /**
     * Get the value of nameComments
     *
     * @return  string
     */ 
    public function getNameComments()
    {
        return $this->nameComments;
    }

    /**
     * Set the value of nameComments
     *
     * @param  string  $nameComments
     *
     * @return  self
     */ 
    public function setNameComments(string $nameComments)
    {
        $this->nameComments = $nameComments;

        return $this;
    }

    /**
     * Get the value of commentary
     *
     * @return  string
     */ 
    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * Set the value of commentary
     *
     * @param  string  $commentary
     *
     * @return  self
     */ 
    public function setCommentary(string $commentary)
    {
        $this->commentary = $commentary;

        return $this;
    }

    /**
     * Get the value of idAdvert
     *
     * @return  \Adverts
     */ 
    public function getIdAdvert()
    {
        return $this->idAdvert;
    }

    /**
     * Set the value of idAdvert
     *
     * @param  \Adverts  $idAdvert
     *
     * @return  self
     */ 
    public function setIdAdvert(\Adverts $idAdvert)
    {
        $this->idAdvert = $idAdvert;

        return $this;
    }
}
