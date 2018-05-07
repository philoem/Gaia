<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Members
 *
 * @ORM\Table(name="members")
 * @ORM\Entity
 */
class Members
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_member", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMember;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=60, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=60, nullable=false)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=60, nullable=false)
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="pw", type="string", length=255, nullable=false)
     */
    private $pw;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_register", type="datetime", nullable=true)
     */
    private $dateRegister;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Adverts", inversedBy="idMember")
     * @ORM\JoinTable(name="ecrire_annonce",
     *   joinColumns={
     *     @ORM\JoinColumn(name="id_member", referencedColumnName="id_member")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="id_advert", referencedColumnName="id_advert")
     *   }
     * )
     */
    private $idAdvert;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAdvert = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get the value of idMember
     *
     * @return  int
     */ 
    public function getIdMember()
    {
        return $this->idMember;
    }

    /**
     * Set the value of idMember
     *
     * @param  int  $idMember
     *
     * @return  self
     */ 
    public function setIdMember(int $idMember)
    {
        $this->idMember = $idMember;

        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string  $firstname
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string  $lastname
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of pseudo
     *
     * @return  string
     */ 
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * Set the value of pseudo
     *
     * @param  string  $pseudo
     *
     * @return  self
     */ 
    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get the value of mail
     *
     * @return  string
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @param  string  $mail
     *
     * @return  self
     */ 
    public function setMail(string $mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get the value of pw
     *
     * @return  string
     */ 
    public function getPw()
    {
        return $this->pw;
    }

    /**
     * Set the value of pw
     *
     * @param  string  $pw
     *
     * @return  self
     */ 
    public function setPw(string $pw)
    {
        $this->pw = $pw;

        return $this;
    }

    /**
     * Get the value of dateRegister
     *
     * @return  \DateTime
     */ 
    public function getDateRegister()
    {
        return $this->dateRegister;
    }

    /**
     * Set the value of dateRegister
     *
     * @param  \DateTime  $dateRegister
     *
     * @return  self
     */ 
    public function setDateRegister(\DateTime $dateRegister)
    {
        $this->dateRegister = $dateRegister;

        return $this;
    }
}
