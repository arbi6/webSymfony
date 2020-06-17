<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SponsorsCompetitions
 *
 * @ORM\Table(name="sponsors_competitions", indexes={@ORM\Index(name="id_sponsor", columns={"id_sponsor"}), @ORM\Index(name="id_competition", columns={"id_competition"})})
 * @ORM\Entity
 */
class SponsorsCompetitions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Competitions
     *
     * @ORM\ManyToOne(targetEntity="Competitions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_competition", referencedColumnName="id")
     * })
     */
    private $idCompetition;

    /**
     * @var \Sponsors
     *
     * @ORM\ManyToOne(targetEntity="Sponsors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sponsor", referencedColumnName="sponsor_id")
     * })
     */
    private $idSponsor;


}

