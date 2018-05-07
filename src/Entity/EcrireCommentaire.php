<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EcrireCommentaire
 *
 * @ORM\Table(name="ecrire_commentaire", indexes={@ORM\Index(name="FK_ecrire_commentaire_id_comment", columns={"id_comment"}), @ORM\Index(name="FK_ecrire_commentaire_id_advert", columns={"id_advert"}), @ORM\Index(name="IDX_729AAC0E56D34F95", columns={"id_member"})})
 * @ORM\Entity
 */
class EcrireCommentaire
{
    /**
     * @var \Adverts
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Adverts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_advert", referencedColumnName="id_advert")
     * })
     */
    private $idAdvert;

    /**
     * @var \Comments
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_comment", referencedColumnName="id_comment")
     * })
     */
    private $idComment;

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


}
