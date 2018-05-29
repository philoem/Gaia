<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 * 
 */
class Contact 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Le nom est obligatoire !")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="L'email est obligatoire !")
     */
    private $email;

    /**
     * @ORM\Column(type="text", length=60, nullable=false)
     * @Assert\NotBlank(message="Vous devez remplir le champs sujet")
     */
     private $subject;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Vous devez remplir le champs text")
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateContact", type="datetime", nullable=false)
     * @ORM\GeneratedValue
     * @Assert\DateTime()
     */
     private $dateContact;

    /**
     * Constructor
     */
     public function __construct()
     {
        
        $this->dateContact = new \DateTime();
        
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of dateContact
     *
     * @return  \DateTime
     */ 
     public function getDateContact()
     {
         return $this->dateContact;
     }
 
     /**
      * Set the value of dateContact
      *
      * @param  \DateTime  $dateContact
      *
      * @return  self
      */ 
     public function setDateContact(\DateTime $dateContact)
     {
         $this->dateContact = $dateContact;
 
         return $this;
     }
}
