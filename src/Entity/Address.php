<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Address
 *
 * @ORM\Table(name="address", indexes={@ORM\Index(name="FK_address_id_member", columns={"id_member"})})
 * @ORM\Entity
 */
class Address
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_adress", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idAdress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nb_street", type="string", length=10, nullable=true)
     */
    private $nbStreet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_street", type="string", length=255, nullable=true)
     */
    private $nameStreet;

    /**
     * @var int|null
     *
     * @ORM\Column(name="code_postal", type="integer", nullable=true)
     */
    private $codePostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="town", type="string", length=255, nullable=true)
     */
    private $town;

    /**
     * @var \Members
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Members")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_member", referencedColumnName="id_member")
     * })
     */
    private $idMember;



    /**
     * Get the value of idAdress
     *
     * @return  int
     */ 
    public function getIdAdress()
    {
        return $this->idAdress;
    }

    /**
     * Set the value of idAdress
     *
     * @param  int  $idAdress
     *
     * @return  self
     */ 
    public function setIdAdress(int $idAdress)
    {
        $this->idAdress = $idAdress;

        return $this;
    }

    /**
     * Get the value of nbStreet
     *
     * @return  string|null
     */ 
    public function getNbStreet()
    {
        return $this->nbStreet;
    }

    /**
     * Set the value of nbStreet
     *
     * @param  string|null  $nbStreet
     *
     * @return  self
     */ 
    public function setNbStreet($nbStreet)
    {
        $this->nbStreet = $nbStreet;

        return $this;
    }

    /**
     * Get the value of nameStreet
     *
     * @return  string|null
     */ 
    public function getNameStreet()
    {
        return $this->nameStreet;
    }

    /**
     * Set the value of nameStreet
     *
     * @param  string|null  $nameStreet
     *
     * @return  self
     */ 
    public function setNameStreet($nameStreet)
    {
        $this->nameStreet = $nameStreet;

        return $this;
    }

    /**
     * Get the value of codePostal
     *
     * @return  int|null
     */ 
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set the value of codePostal
     *
     * @param  int|null  $codePostal
     *
     * @return  self
     */ 
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get the value of town
     *
     * @return  string|null
     */ 
    public function getTown()
    {
        return $this->town;
    }

    /**
     * Set the value of town
     *
     * @param  string|null  $town
     *
     * @return  self
     */ 
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }
}
