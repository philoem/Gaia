<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\NotBlank(message="Le prénom est obligatoire !")
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=60, nullable=false)
     * @Assert\NotBlank(message="Le nom est obligatoire !")
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=60, nullable=false)
     * @Assert\NotBlank(message="Le pseudonyme est obligatoire !")
     * @Assert\Valid
     */
    private $pseudo;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="L'email est impératif !")
     * @Assert\Email(message="L'email '{{ value }}' n'est pas un format valide")
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="pw", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Choisissez un mot de passe !")
     * @Assert\Valid
     */
    private $pw;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_register", type="datetime", nullable=false)
     * @ORM\GeneratedValue
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
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Répétez votre mot de passe ")
     * @Assert\EqualTo(
     *  propertyPath="pw",
     *  message="Le mot de passe doit être identique à celui tapé au-dessus")
     * 
     */
    private $repeat_pw;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idAdvert = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateRegister = new \DateTime('NOW');
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
        $pw = sha1($pw);
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

    /**
     * Get the value of idAdvert
     *
     * @return  \Doctrine\Common\Collections\Collection
     */ 
    public function getIdAdvert()
    {
        return $this->idAdvert;
    }

    /**
     * Set the value of idAdvert
     *
     * @param  \Doctrine\Common\Collections\Collection  $idAdvert
     *
     * @return  self
     */ 
    public function setIdAdvert(\Doctrine\Common\Collections\Collection $idAdvert)
    {
        $this->idAdvert = $idAdvert;

        return $this;
    }

    public function getRepeatPw(): ?string
    {
        return $this->repeat_pw;
    }

    public function setRepeatPw(string $repeat_pw): self
    {
        $repeat_pw = sha1($repeat_pw);
        $this->repeat_pw = $repeat_pw;

        return $this;
    }
}
