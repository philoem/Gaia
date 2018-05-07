<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Avatar
 *
 * @ORM\Table(name="avatar", indexes={@ORM\Index(name="FK_avatar_id_member", columns={"id_member"})})
 * @ORM\Entity
 */
class Avatar
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_avatar", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idAvatar;

    /**
     * @var float|null
     *
     * @ORM\Column(name="picture", type="float", precision=10, scale=0, nullable=true)
     */
    private $picture;

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
     * Get the value of idAvatar
     *
     * @return  int
     */ 
    public function getIdAvatar()
    {
        return $this->idAvatar;
    }

    /**
     * Set the value of idAvatar
     *
     * @param  int  $idAvatar
     *
     * @return  self
     */ 
    public function setIdAvatar(int $idAvatar)
    {
        $this->idAvatar = $idAvatar;

        return $this;
    }

    /**
     * Get the value of picture
     *
     * @return  float|null
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  float|null  $picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }
}
