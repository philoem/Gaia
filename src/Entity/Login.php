<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoginRepository")
 * 
 */
class Login 
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(name="username_login",type="string", length=60)
     * @Assert\NotBlank(message="Veuillez taper votre pseudonyme")
     * Assert\Valid
     */
    private $username_login;

    /**
     * @ORM\Column(name="password_login",type="string", length=255)
     * @Assert\NotBlank(message="Veuillez taper votre mot de passe")
     * @Assert\Valid
     * 
     */
    private $password_login;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $role_login;
	
        
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of username_login
     *
     * @return  string
     */
    public function getUsernameLogin(): ?string
    {
        return $this->username_login;
    }

    /**
     * Set the value of username_login
     *
     * @param  string  $username_login
     *
     * @return  self
     */
    public function setUsernameLogin(string $username_login): self
    {
        $this->username_login = $username_login;

        return $this;
    }

    /**
     * Get the value of password_login
     *
     * @return  string
     */
    public function getPasswordLogin(): ?string
    {
        return $this->password_login;
    }

    /**
     * Set the value of password_login
     *
     * @param  string  $password_login
     *
     * @return  self
     */ 
    public function setPasswordLogin(string $password_login): self
    {
        $this->password_login = $password_login;

        return $this;
    }

    public function getRoleLogin(): ?array
    {
        $role_login = $this->role_login;
        if (empty($role_login)){
            $role_login[] = 'ROLE_USER';
        }
        return array_unique($role_login);
    }

    public function setRoleLogin(?array $role_login): self
    {
        $this->role_login = $role_login;

        return $this;
    }
    
}
