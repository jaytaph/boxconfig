<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * BoxConfig\BoxBundle\Entity\Configuration
 *
 * @ORM\Table(name="configuration")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Configuration
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
     * @ORM\ManyToOne(targetEntity="BoxConfig\AccountBundle\Entity\User")
     */
    protected $user;

    /**
     * * @ORM\Column(type="boolean")
     */
    protected $virtualized;


    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\BoxBundle\Entity\Operatingsystem")
     */
    protected $operatingsystem;

    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\BoxBundle\Entity\Machine")
     */
    protected $machine;


    // ManyToMany for now. Change this if we need more info about the software on your system (like custom messages)
    /**
     * @ORM\ManyToMany(targetEntity="BoxConfig\BoxBundle\Entity\Software")
     */
    protected $software;


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
     * Set virtualized
     *
     * @param boolean $virtualized
     */
    public function setVirtualized($virtualized)
    {
        $this->virtualized = $virtualized;
    }

    /**
     * Get virtualized
     *
     * @return boolean 
     */
    public function getVirtualized()
    {
        return $this->virtualized;
    }

    /**
     * Set user
     *
     * @param \BoxConfig\AccountBundle\Entity\User $user
     */
    public function setUser(\BoxConfig\AccountBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return \BoxConfig\AccountBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set machine
     *
     * @param \BoxConfig\BoxBundle\Entity\Machine $machine
     */
    public function setMachine(\BoxConfig\BoxBundle\Entity\Machine $machine)
    {
        $this->machine = $machine;
    }

    /**
     * Get machine
     *
     * @return \BoxConfig\BoxBundle\Entity\Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Set Operatingsystem
     *
     * @param \BoxConfig\BoxBundle\Entity\Operatingsystem $operatingsystem
     */
    public function setOperatingsystem(\BoxConfig\BoxBundle\Entity\Operatingsystem $operatingsystem)
    {
        $this->operatingsystem = $operatingsystem;
    }

    /**
     * Get operatingSystem
     *
     * @return \BoxConfig\BoxBundle\Entity\Operatingsystem
     */
    public function getOperatingsystem()
    {
        return $this->operatingsystem;
    }

    public function __construct()
    {
        $this->software = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add software
     *
     * @param BoxConfig\BoxBundle\Entity\Software $software
     */
    public function addSoftware(\BoxConfig\BoxBundle\Entity\Software $software)
    {
        $this->software[] = $software;
    }

    /**
     * Get software
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSoftware()
    {
        return $this->software;
    }
}