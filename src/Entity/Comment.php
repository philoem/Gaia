<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $commentary;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Advert", inversedBy="comments")
     * @ORM\JoinColumn(name="advert_id",nullable=false, referencedColumnName="id_advert")
     */
    private $adverts;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateComment;

    /**
    * Constructor
    */
    public function __construct()
    {
        $this->dateComment = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getAdverts(): ?Advert
    {
        return $this->adverts;
    }

    public function setAdverts(Advert $advert): self
    {
        $this->adverts = $advert;

        return $this;
    }

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->dateComment;
    }

    public function setDateComment(\DateTimeInterface $dateComment): self
    {
        $this->dateComment = $dateComment;

        return $this;
    }
}
