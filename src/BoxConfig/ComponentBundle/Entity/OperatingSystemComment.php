<?php

namespace BoxConfig\ComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\ComponentBundle\Entity\OperatingSystemComment
 *
 * @ORM\Entity
 * @ORM\Table(name="comment_operatingsystem")
 */
class OperatingSystemComment extends Comment
{

    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\ComponentBundle\Entity\OperatingSystem")
     */
    protected $operatingsystem;

    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var datetime $created
     */
    protected $created;

    /**
     * @var text $comment
     */
    protected $comment;

    /**
     * @var BoxConfig\AccountBundle\Entity\User
     */
    protected $user;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set created
     *
     * @param datetime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return datetime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set operatingsystem
     *
     * @param BoxConfig\ComponentBundle\Entity\OperatingSystem $operatingsystem
     */
    public function setOperatingsystem(\BoxConfig\ComponentBundle\Entity\OperatingSystem $operatingsystem)
    {
        $this->operatingsystem = $operatingsystem;
    }

    /**
     * Get operatingsystem
     *
     * @return BoxConfig\ComponentBundle\Entity\OperatingSystem 
     */
    public function getOperatingsystem()
    {
        return $this->operatingsystem;
    }

    /**
     * Set user
     *
     * @param BoxConfig\AccountBundle\Entity\User $user
     */
    public function setUser(\BoxConfig\AccountBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return BoxConfig\AccountBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var integer $rating
     */
    protected $rating;


    /**
     * Set rating
     *
     * @param integer $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }
}