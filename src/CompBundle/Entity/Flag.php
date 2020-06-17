<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flag
 *
 * @ORM\Table(name="flag")
 * @ORM\Entity
 */
class Flag
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
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=255, nullable=false)
     */
    private $flag;


}

