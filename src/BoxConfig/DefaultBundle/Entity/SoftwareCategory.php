<?php

namespace BoxConfig\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\DefaultBundle\Entity\SoftwareCategory
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

    public function __construct() {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString() {
        $ret = "";
        if ($this->getParent() instanceof \BoxConfig\DefaultBundle\Entity\SoftwareCategory) {
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
     * @param BoxConfig\DefaultBundle\Entity\SoftwareCategory $children
     */
    public function addSoftwareCategory(\BoxConfig\DefaultBundle\Entity\SoftwareCategory $children)
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
     * @param BoxConfig\DefaultBundle\Entity\SoftwareCategory $parent
     */
    public function setParent(\BoxConfig\DefaultBundle\Entity\SoftwareCategory $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return BoxConfig\DefaultBundle\Entity\SoftwareCategory 
     */
    public function getParent()
    {
        return $this->parent;
    }
}