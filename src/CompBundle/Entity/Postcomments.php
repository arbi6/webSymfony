<?php

namespace CompBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Postcomments
 *
 * @ORM\Table(name="postcomments")
 * @ORM\Entity(repositoryClass="CompBundle\Repository\PostcommentsRepository")
 */
class Postcomments
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
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="post_at", type="time")
     */
    private $postAt;


    /**
     * @ORM\ManyToOne(targetEntity="CompBundle\Entity\Users", inversedBy="comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param mixed $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }





    /**
     * @ORM\ManyToOne(targetEntity="CompBundle\Entity\Post", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $post;
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
     * Set postAt
     *
     * @param \DateTime $postAt
     *
     * @return Postcomments
     */
    public function setPostAt()
    {
        $this->postAt = neW \DateTime('now');

        return $this;
    }

    /**
     * Get postAt
     *
     * @return \DateTime
     */
    public function getPostAt()
    {
        return $this->postAt;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }



    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

}

