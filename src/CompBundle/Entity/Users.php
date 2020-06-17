<?php

namespace CompBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class Users extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=11, nullable=true)
     */
    private $fullName;


    /**
     * @var string
     *
     * @ORM\Column(name="karma_pts", type="string", length=255, nullable=true)
     */
    private $karmaPts;



    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="badges", type="string", length=255, nullable=true)
     */
    private $badges;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @var \Flag
     *
     * @ORM\ManyToOne(targetEntity="Flag")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="flag_id", referencedColumnName="id")
     * })
     */
    private $flag;

    /**
     * @var \Role
     *
     * @ORM\ManyToOne(targetEntity="Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    protected $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Castings", mappedBy="users")
     */
    private $castings;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Competitions", inversedBy="users")
     * @ORM\JoinTable(name="users_competitions",
     *   joinColumns={
     *     @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="competitions_id", referencedColumnName="id")
     *   }
     * )
     */
    private $competitions;
    /**
     * @ORM\OneToMany(targetEntity="CompBundle\Entity\Postcomments", mappedBy="user")
     */
    private $comments;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->castings = new \Doctrine\Common\Collections\ArrayCollection();
        $this->competitions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->karmaPts = 0;
        $this->phone=0;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getKarmaPts()
    {
        return $this->karmaPts;
    }

    /**
     * @param string $karmaPts
     */
    public function setKarmaPts($karmaPts)
    {
        $this->karmaPts = $karmaPts;
    }

    /**
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param int $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return string
     */
    public function getBadges()
    {
        return $this->badges;
    }

    /**
     * @param string $badges
     */
    public function setBadges($badges)
    {
        $this->badges = $badges;
    }

    /**
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param string $avatar
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    /**
     * @return \Flag
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * @param \Flag $flag
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    }

    /**
     * @return \Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param \Role $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCastings()
    {
        return $this->castings;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $castings
     */
    public function setCastings($castings)
    {
        $this->castings = $castings;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompetitions()
    {
        return $this->competitions;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $competitions
     */
    public function setCompetitions($competitions)
    {
        $this->competitions = $competitions;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
    }


}

