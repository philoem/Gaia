<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoginRepository")
 * @UniqueEntity(fields="username_login", message="Ce pseudonyme est déjà pris")
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
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Veuillez taper votre pseudonyme")
     * @Assert\Valid
     */
    private $username_login;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank(message="Veuillez taper votre mot de passe")
     * @Assert\Valid
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

    public function getUsernameLogin(): ?string
    {
        return $this->username_login;
    }

    public function setUsernameLogin(string $username_login): self
    {
        $this->username_login = $username_login;

        return $this;
    }

    public function getPassword_login(): ?string
    {
        return $this->password_login;
    }

    public function setPassword_login(string $password_login): self
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
