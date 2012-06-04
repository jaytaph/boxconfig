<?php

namespace BoxConfig\AccountBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\AccountBundle\Entity\User
 *
 * @ORM\Table(name="account")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var datetime $createdDt
     *
     * @ORM\Column(name="created_dt", type="datetime", nullable=false)
     */
    protected $createdDt;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

//    /**
//     * Set username
//     *
//     * @param string $username
//     */
//    public function setUsername($username)
//    {
//        $this->username = $username;
//    }
//
//    /**
//     * Get username
//     *
//     * @return string
//     */
//    public function getUsername()
//    {
//        return $this->username;
//    }
//
//    /**
//     * Set email
//     *
//     * @param string $email
//     */
//    public function setEmail($email)
//    {
//        $this->email = $email;
//    }
//
//    /**
//     * Get email
//     *
//     * @return string
//     */
//    public function getEmail()
//    {
//        return $this->email;
//    }
//
//    /**
//     * Set password
//     *
//     * @param string $password
//     */
//    public function setPassword($password)
//    {
//        $this->password = $password;
//    }
//
//    /**
//     * Get password
//     *
//     * @return string
//     */
//    public function getPassword()
//    {
//        return $this->password;
//    }
//
//    /**
//     * Set salt
//     *
//     * @param string $salt
//     */
//    public function setSalt($salt)
//    {
//        $this->salt = $salt;
//    }
//
//    /**
//     * Get salt
//     *
//     * @return string
//     */
//    public function getSalt()
//    {
//        return $this->salt;
//    }

    /**
     * Set createdDt
     *
     * @param datetime $createdDt
     */
    public function setCreatedDt($createdDt)
    {
        $this->createdDt = $createdDt;
    }

    /**
     * Get createdDt
     *
     * @return datetime 
     */
    public function getCreatedDt()
    {
        return $this->createdDt;
    }

    /**
     * @ORM\PrePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->createdDt = new \DateTime(date('Y-m-d H:m:s'));
    }
}