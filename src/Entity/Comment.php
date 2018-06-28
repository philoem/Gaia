<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table(name="comment", indexes={@ORM\Index(name="FK_comment_id_advert", columns={"id_advert"})})
 * @ORM\Entity
 */
class Comment
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
     * @var \Advert
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Advert")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_advert", referencedColumnName="id_advert")
     * })
     */
    private $idAdvert;

    public function getIdComment(): ?int
    {
        return $this->idComment;
    }

    public function getNameComments(): ?string
    {
        return $this->nameComments;
    }

    public function setNameComments(string $nameComments): self
    {
        $this->nameComments = $nameComments;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(string $commentary): self
    {
        $this->commentary = $commentary;

        return $this;
    }

    public function getIdAdvert(): ?Adverts
    {
        return $this->idAdvert;
    }

    public function setIdAdvert(?Adverts $idAdvert): self
    {
        $this->idAdvert = $idAdvert;

        return $this;
    }


}
