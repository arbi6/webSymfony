<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competitions
 *
 * @ORM\Table(name="competitions")
 * @ORM\Entity
 */
class Competitions
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
     * @ORM\Column(name="competition_name", type="string", length=255, nullable=false)
     */
    private $competitionName;

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
     * @ORM\Column(name="participants_nbr", type="integer", nullable=false)
     */
    private $participantsNbr;

    /**
     * @var integer
     *
     * @ORM\Column(name="place_dispo", type="integer", nullable=true)
     */
    private $placeDispo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Users", mappedBy="competitions")
     */
    private $users;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getCompetitionName()
    {
        return $this->competitionName;
    }

    /**
     * @param string $competitionName
     */
    public function setCompetitionName($competitionName)
    {
        $this->competitionName = $competitionName;
    }

    /**
     * @return \DateTime
     */
    public function getStartTimeStamp()
    {
        return $this->startTimeStamp;
    }

    /**
     * @param \DateTime $startTimeStamp
     */
    public function setStartTimeStamp($startTimeStamp)
    {
        $this->startTimeStamp = $startTimeStamp;
    }

    /**
     * @return \DateTime
     */
    public function getEndTimeStamp()
    {
        return $this->endTimeStamp;
    }

    /**
     * @param \DateTime $endTimeStamp
     */
    public function setEndTimeStamp($endTimeStamp)
    {
        $this->endTimeStamp = $endTimeStamp;
    }

    /**
     * @return int
     */
    public function getParticipantsNbr()
    {
        return $this->participantsNbr;
    }

    /**
     * @param int $participantsNbr
     */
    public function setParticipantsNbr($participantsNbr)
    {
        $this->participantsNbr = $participantsNbr;
    }

    /**
     * @return int
     */
    public function getPlaceDispo()
    {
        return $this->placeDispo;
    }

    /**
     * @param int $placeDispo
     */
    public function setPlaceDispo($placeDispo)
    {
        $this->placeDispo = $placeDispo;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

}

