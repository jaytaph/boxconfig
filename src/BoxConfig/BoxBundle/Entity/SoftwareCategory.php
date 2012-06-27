<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\BoxBundle\Entity\SoftwareCategory
 *
 * @ORM\Table(name="softwareCategory")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class SoftwareCategory
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
     * @ORM\OneToMany(targetEntity="SoftwareCategory", mappedBy="parent")
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="SoftwareCategory", inversedBy="children")
     */
    protected $parent;

    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $inTop = false;


    public function __construct() {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        $ret = "";
        if ($this->getParent() instanceof \BoxConfig\BoxBundle\Entity\SoftwareCategory) {
            $ret =  $this->getParent() . " - ";
        }
        return $ret . $this->getName();
    }

    public function getFullPath() {
        return (string)$this;
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
     * Add children
     *
     * @param BoxConfig\BoxBundle\Entity\SoftwareCategory $children
     */
    public function addSoftwareCategory(\BoxConfig\BoxBundle\Entity\SoftwareCategory $children)
    {
        $this->children[] = $children;
    }

    /**
     * Get children
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param BoxConfig\BoxBundle\Entity\SoftwareCategory $parent
     */
    public function setParent(\BoxConfig\BoxBundle\Entity\SoftwareCategory $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return BoxConfig\BoxBundle\Entity\SoftwareCategory
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set inTop
     *
     * @param boolean $inTop
     */
    public function setInTop($inTop)
    {
        $this->inTop = $inTop;
    }

    /**
     * Get inTop
     *
     * @return boolean 
     */
    public function getInTop()
    {
        return $this->inTop;
    }
}