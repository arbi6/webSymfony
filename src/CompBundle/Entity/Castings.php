<?php

namespace CompBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Castings
 *
 * @ORM\Table(name="castings")
 * @ORM\Entity
 */
class Castings
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
     * @ORM\Column(name="name_casting", type="string", length=50, nullable=false)
     */
    private $nameCasting;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time_stamp", type="datetime", nullable=false)
     */
    private $startTimeStamp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time_stamp", type="datetime", nullable=false)
     */
    private $endTimeStamp;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbr_participant", type="integer", nullable=false)
     */
    private $nbrParticipant;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Users", inversedBy="castings")
     * @ORM\JoinTable(name="castings_users",
     *   joinColumns={
     *     @ORM\JoinColumn(name="castings_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     *   }
     * )
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

