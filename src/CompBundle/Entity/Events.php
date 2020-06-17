<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 */
class Events
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
     * @ORM\Column(name="event_name", type="string", length=255, nullable=false)
     */
    private $eventName;

    /**
     * @var integer
     *
     * @ORM\Column(name="participants_nbr", type="integer", nullable=false)
     */
    private $participantsNbr;

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


}

