<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\BoxBundle\Entity\Hardware
 *
 * @ORM\Table(name="hardware")
 * @ORM\Entity(repositoryClass="BoxConfig\BoxBundle\Repository\HardwareRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Hardware
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

    // TODO: Add more stuff: images, descriptions, hardware list etc

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    function __toString() {
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
}