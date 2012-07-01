<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * BoxConfig\BoxBundle\Entity\Machine
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity(repositoryClass="BoxConfig\BoxBundle\Repository\MachineRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Machine
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
     * @ORM\ManyToOne(targetEntity="BoxConfig\ComponentBundle\Entity\Hardware")
     */
    protected $hardware;


    /**
     * @ORM\Column(name="name", type="string", length="50")
     */
    protected $name;


    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;



    /**
     * @ORM\Column(name="active", type="boolean")
     */
    protected $active = true;

    /**
     * @ORM\Column(name="start_dt", type="date", nullable=true)
     */
    protected $startdate;

    /**
     * @ORM\Column(name="end_dt", type="date", nullable=true)
     */
    protected $enddate;

    /**
     * @ORM\OneToMany(targetEntity="BoxConfig\BoxBundle\Entity\Environment", mappedBy="machine")
     */
    protected $environments;



    function __toString()
    {
        return $this->getName();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set active
     *
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set startdate
     *
     * @param date $startdate
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;
    }

    /**
     * Get startdate
     *
     * @return date 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set enddate
     *
     * @param date $enddate
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;
    }

    /**
     * Get enddate
     *
     * @return date 
     */
    public function getEnddate()
    {
        return $this->enddate;
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
     * Set hardware
     *
     * @param BoxConfig\ComponentBundle\Entity\Hardware $hardware
     */
    public function setHardware(\BoxConfig\ComponentBundle\Entity\Hardware $hardware)
    {
        $this->hardware = $hardware;
    }

    /**
     * Get hardware
     *
     * @return BoxConfig\ComponentBundle\Entity\Hardware
     */
    public function getHardware()
    {
        return $this->hardware;
    }

    public function __construct()
    {
        $this->environments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add environments
     *
     * @param BoxConfig\BoxBundle\Entity\Environment $environments
     */
    public function addEnvironment(\BoxConfig\BoxBundle\Entity\Environment $environments)
    {
        $this->environments[] = $environments;
    }

    /**
     * Get environments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEnvironments()
    {
        return $this->environments;
    }
}