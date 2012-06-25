<?php

namespace BoxConfig\AccountBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @ORM\Column(name="full_name", type="string", length="100", nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your full name.", groups={"Registration", "Profile"})
     * @Assert\MinLength(limit="3", message="The name is too short.", groups={"Registration", "Profile"})
     * @Assert\MaxLength(limit="100", message="The name is too long.", groups={"Registration", "Profile"})
     */
    protected $fullname;

    /**
     * @ORM\Column(name="twitter", type="string", length="50", nullable=true)
     */
    protected $twitterHandle;


    /**
     * @ORM\OneToMany(targetEntity="BoxConfig\BoxBundle\Entity\Configuration", mappedBy="user")
     */
    protected $configurations;

    /**
     * @ORM\OneToMany(targetEntity="BoxConfig\BoxBundle\Entity\Machine", mappedBy="user")
     */
    protected $machines;





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

    /**
     * Set fullname
     *
     * @param string $fullname
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }

    /**
     * Get fullname
     *
     * @return string 
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Set twitterHandle
     *
     * @param string $twitterHandle
     */
    public function setTwitterHandle($twitterHandle)
    {
        $this->twitterHandle = $twitterHandle;
    }

    /**
     * Get twitterHandle
     *
     * @return string 
     */
    public function getTwitterHandle()
    {
        return $this->twitterHandle;
    }
    public function __construct()
    {
        $this->configurations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add configurations
     *
     * @param BoxConfig\BoxBundle\Entity\Configuration $configurations
     */
    public function addConfiguration(\BoxConfig\BoxBundle\Entity\Configuration $configurations)
    {
        $this->configurations[] = $configurations;
    }

    /**
     * Get configurations
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getConfigurations()
    {
        return $this->configurations;
    }

    /**
     * Add machines
     *
     * @param BoxConfig\BoxBundle\Entity\Machine $machines
     */
    public function addMachine(\BoxConfig\BoxBundle\Entity\Machine $machines)
    {
        $this->machines[] = $machines;
    }

    /**
     * Get machines
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getMachines()
    {
        return $this->machines;
    }
}