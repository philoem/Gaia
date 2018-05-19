<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Login
 * @ORM\Table(name="login")
 * @ORM\Entity(repositoryClass="App\Repository\LoginRepository")
 *
 * 
 */
class Login implements AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="username",type="string", length=60)
     * @Assert\NotBlank(message="Veuillez taper votre pseudonyme")
     * @Assert\Valid
     */
    private $username;

    /**
     * @ORM\Column(name="password",type="string", length=255)
     * @Assert\NotBlank(message="Veuillez taper votre mot de passe")
     * @Assert\Valid
     * 
     */
    private $password;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $roles;

    /**
     * @ORM\Column(name="salt", nullable=true)
     */
    private $salt;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
    }


    /**
     * Get the value of salt
     *
     * @return  string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    public function eraseCredentials()
    {

    }



	
        
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username
     *
     * @return  string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @param  string  $username
     *
     * @return  self
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of password
     *
     * @return  string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @param  string  $password
     *
     * @return  self
     */ 
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRoles(): ?array
    {
        $roles = $this->roles;
        if (empty($roles)){
            $roles[] = 'ROLE_USER';
        }
        return array_unique($roles);
    }

    public function setRoles(?array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

    // serialize and unserialize must be updated - see below
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->isActive,
        ) = unserialize($serialized);
    }
    
}
