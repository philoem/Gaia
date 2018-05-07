<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BirthDate
 *
 * @ORM\Table(name="birth_date", indexes={@ORM\Index(name="FK_birth_date_id_member", columns={"id_member"})})
 * @ORM\Entity
 */
class BirthDate
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_birth_date", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idBirthDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birthDate;

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
     * Get the value of idBirthDate
     *
     * @return  int
     */ 
    public function getIdBirthDate()
    {
        return $this->idBirthDate;
    }

    /**
     * Set the value of idBirthDate
     *
     * @param  int  $idBirthDate
     *
     * @return  self
     */ 
    public function setIdBirthDate(int $idBirthDate)
    {
        $this->idBirthDate = $idBirthDate;

        return $this;
    }

    /**
     * Get the value of birthDate
     *
     * @return  \DateTime|null
     */ 
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @param  \DateTime|null  $birthDate
     *
     * @return  self
     */ 
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }
}
