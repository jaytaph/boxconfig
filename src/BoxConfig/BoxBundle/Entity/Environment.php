<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * BoxConfig\BoxBundle\Entity\Environment
 *
 * @ORM\Table(name="environment")
 * @ORM\Entity(repositoryClass="BoxConfig\BoxBundle\Repository\EnvironmentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Environment
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
     * * @ORM\Column(type="boolean")
     */
    protected $virtualized;


    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\BoxBundle\Entity\OperatingSystem")
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



    public function __construct()
    {
        $this->software = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set operatingsystem
     *
     * @param BoxConfig\BoxBundle\Entity\OperatingSystem $operatingsystem
     */
    public function setOperatingsystem(\BoxConfig\BoxBundle\Entity\OperatingSystem $operatingsystem)
    {
        $this->operatingsystem = $operatingsystem;
    }

    /**
     * Get operatingsystem
     *
     * @return BoxConfig\BoxBundle\Entity\OperatingSystem 
     */
    public function getOperatingsystem()
    {
        return $this->operatingsystem;
    }

    /**
     * Set machine
     *
     * @param BoxConfig\BoxBundle\Entity\Machine $machine
     */
    public function setMachine(\BoxConfig\BoxBundle\Entity\Machine $machine)
    {
        $this->machine = $machine;
    }

    /**
     * Get machine
     *
     * @return BoxConfig\BoxBundle\Entity\Machine 
     */
    public function getMachine()
    {
        return $this->machine;
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