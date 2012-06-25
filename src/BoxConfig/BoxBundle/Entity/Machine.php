<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\BoxBundle\Entity\Machine
 *
 * @ORM\Table(name="machine")
 * @ORM\Entity
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
     * @ORM\Column(type="string", length="255")
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $inUse;

    /**
     * @ORM\Column(type="text")
     */
    protected $description;


    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\BoxBundle\Entity\Hardware")
     */
    protected $hardware;

    /**
     * @ORM\ManyToOne(targetEntity="BoxConfig\AccountBundle\Entity\User")
     */
    protected $user;





    function __toString() {
        if (empty($name)) {
            return (string)$this->getHardware();
        }
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
     * Set inUse
     *
     * @param boolean $inUse
     */
    public function setInUse($inUse)
    {
        $this->inUse = $inUse;
    }

    /**
     * Get inUse
     *
     * @return boolean 
     */
    public function getInUse()
    {
        return $this->inUse;
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
     * Set hardware
     *
     * @param BoxConfig\BoxBundle\Entity\Hardware $hardware
     */
    public function setHardware(\BoxConfig\BoxBundle\Entity\Hardware $hardware)
    {
        $this->hardware = $hardware;
    }

    /**
     * Get hardware
     *
     * @return BoxConfig\BoxBundle\Entity\Hardware 
     */
    public function getHardware()
    {
        return $this->hardware;
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
}