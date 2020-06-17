<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sponsors
 *
 * @ORM\Table(name="sponsors")
 * @ORM\Entity
 */
class Sponsors
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sponsor_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sponsorId;

    /**
     * @var string
     *
     * @ORM\Column(name="sponsor_name", type="string", length=255, nullable=false)
     */
    private $sponsorName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;


}

