<?php

namespace BoxConfig\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * BoxConfig\DefaultBundle\Entity\Configuration
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
     * @ORM\ManyToOne(targetEntity="BoxConfig\DefaultBundle\Entity\OperatingSystem")
     */
    protected $operatingSystem;

    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\DefaultBundle\Entity\Machine")
     */
    protected $machine;


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
     * @param \BoxConfig\DefaultBundle\Entity\Machine $machine
     */
    public function setMachine(\BoxConfig\DefaultBundle\Entity\Machine $machine)
    {
        $this->machine = $machine;
    }

    /**
     * Get machine
     *
     * @return \BoxConfig\DefaultBundle\Entity\Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Set operatingSystem
     *
     * @param \BoxConfig\DefaultBundle\Entity\OperatingSystem $operatingSystem
     */
    public function setOperatingSystem(\BoxConfig\DefaultBundle\Entity\Operatingsystem $operatingSystem)
    {
        $this->operatingSystem = $operatingSystem;
    }

    /**
     * Get operatingSystem
     *
     * @return \BoxConfig\DefaultBundle\Entity\OperatingSystem
     */
    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }

}