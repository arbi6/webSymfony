<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * aime
 *
 * @ORM\Table(name="aime")
 * @ORM\Entity(repositoryClass="CompBundle\Repository\aimeRepository")
 */
class aime
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

