<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Valid;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Advert
 *
 * @ORM\Table(name="advert")
 * @ORM\Entity(repositoryClass="App\Repository\AdvertsRepository")
 */
class Advert
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Member", inversedBy="adverts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $member;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdverts", type="datetime", nullable=false)
     * @ORM\GeneratedValue
     * @Assert\Type(type="\DateTime")
     */
    private $dateAdverts;

    /**
     * @var string
     * @ORM\Column(name="picturesAdverts", type="string", nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg", "image/png" })
     */
    private $picturesAdverts;

    /**
    * @var string
    * @ORM\Column(name="town", type="string", nullable=false)
    * @Assert\NotBlank(message="La ville est obligatoire")
    */
    private $town;

    /**
     * @var string
     *
     * @ORM\Column(name="usernameMember", type="string", nullable=false)
     */
    private $usernameMember;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="adverts", orphanRemoval=true, cascade={"persist"})
     * @ORM\JoinColumn
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        //$this->member = new ArrayCollection();
        $this->dateAdverts = new \DateTime();
        $this->comments = new ArrayCollection();
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

    public function getMember(): ?Member
    {
        return $this->member;
    }

    public function setMember(?Member $member)
    {
        $this->member = $member;
        return $this;
    }

    /**
    * Get the value of dateAdverts
    *
    * @return  \DateTime
    */ 
    public function getDateAdverts()
    {
        return $this->dateAdverts;
    }
 
     /**
    * Set the value of dateAdverts
    *
    * @param  \DateTime  $dateRegister
    *
    * @return  self
    */ 
    public function setDateAdverts(\DateTime $dateAdverts)
    {
        $this->dateAdverts = $dateAdverts;

        return $this;
    }

    /**
    * Get the value of picturesAdverts
    *
    * @return  string
    */ 
    public function getPicturesAdverts()
    {
        return $this->picturesAdverts;
    }

    /**
    * Set the value of picturesAdverts
    *
    * @param  string  $picturesAdverts
    *
    * @return  self
    */ 
    public function setPicturesAdverts($picturesAdverts = null)
    {
        $this->picturesAdverts = $picturesAdverts;

        return $this;
    }

    /**
    * Get the value of town
    *
    * @return  string
    */ 
    public function getTown()
    {
        return $this->town;
    }

    /**
    * Set the value of town
    *
    * @param  string  $town
    *
    * @return  self
    */ 
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
    * Get the value of usernameMember
    *
    * @return  string
    */ 
    public function getUsernameMember()
    {
        return $this->usernameMember;
    }

    /**
    * Set the value of usernameMember
    *
    * @param  string  $usernameMember
    *
    * @return  self
    */ 
    public function setUsernameMember($usernameMember)
    {
        $this->usernameMember = $usernameMember;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAdverts($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAdverts() === $this) {
                $comment->setAdverts(null);
            }
        }

        return $this;
    }

   
}
