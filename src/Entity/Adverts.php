<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Adverts
 *
 * @ORM\Table(name="adverts")
 * @ORM\Entity
 */
class Adverts
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_advert", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAdvert;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=60, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=false)
     */
    private $content;

    /**
     * @var float|null
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Members", mappedBy="idAdvert")
     */
    private $idMember;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idMember = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get the value of idAdvert
     *
     * @return  int
     */ 
    public function getIdAdvert()
    {
        return $this->idAdvert;
    }

    /**
     * Set the value of idAdvert
     *
     * @param  int  $idAdvert
     *
     * @return  self
     */ 
    public function setIdAdvert(int $idAdvert)
    {
        $this->idAdvert = $idAdvert;

        return $this;
    }

    /**
     * Get the value of title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  string  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of content
     *
     * @return  string
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string  $content
     *
     * @return  self
     */ 
    public function setContent(string $content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of price
     *
     * @return  float|null
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float|null  $price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}
