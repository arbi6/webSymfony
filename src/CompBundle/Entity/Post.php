<?php

namespace CompBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use CompBundle\Entity\Postcomments;



/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="CompBundle\Repository\PostRepository")
 */
class Post
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="postdate", type="date")
     */
    private $postdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="getdate", type="date")
     */

    private $getdate;


    /**
     * @ORM\OneToMany(targetEntity="CompBundle\Entity\Postcomments", mappedBy="post")
     */
    private $comments;

public function __construct()
{
    $this->comments = new ArrayCollection();
}

public function addPostcomments(Postcomments $postcomments): self
{
    if(!$this->comments->contains($postcomments)){
        $this->comments[] = $postcomments;
        $postcomments->setPost($this);
    }


}
    /**
     * @ORM\ManyToOne(targetEntity="CompBundle\Entity\Users")
     *@ORM\JoinColumn(name="creator", referencedColumnName="id")
     */
    private $creator;

    /**
     * @return mixed
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param mixed $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
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







    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Post
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Post
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set postdate
     *
     * @param \DateTime $postdate
     *
     * @return Post
     */
    public function setPostdate($postdate)
    {
        $this->postdate = $postdate;

        return $this;
    }

    /**
     * Get postdate
     *
     * @return \DateTime
     */
    public function getPostdate()
    {
        return $this->postdate;
    }

    /**
     * Set getdate
     *
     * @param \DateTime $getdate
     *
     * @return Post
     */
    public function setGetdate($getdate)
    {
        $this->getdate = $getdate;

        return $this;
    }
    /**
     * Get getdate
     *
     * @return \DateTime
     */
    public function getGetdate()
    {
        return $this->getdate;
    }
}

