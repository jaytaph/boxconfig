<?php

namespace BoxConfig\ComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\ComponentBundle\Entity\Software
 *
 * @ORM\Table(name="software")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Software
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
     * @ORM\Column(type="string", length="255")
     */
    protected $manufacturer;


    /**
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $url;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $opensource;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $demo;

    /**
     * @ORM\Column(type="string", length="255", nullable="true")
     */
    protected $opensourcelicense;


    /**
     * @ORM\ManyToOne(targetEntity="SoftwareCategory")
     */
    protected $category;

    /**
     * @ORM\OneToMany(targetEntity="BoxConfig\ComponentBundle\Entity\SoftwareComment", mappedBy="software")
     */
    protected $comments;



    public function __toString()
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
     * Set manufacturer
     *
     * @param string $manufacturer
     */
    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    /**
     * Get manufacturer
     *
     * @return string 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
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
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set opensource
     *
     * @param boolean $opensource
     */
    public function setOpensource($opensource)
    {
        $this->opensource = $opensource;
    }

    /**
     * Get opensource
     *
     * @return boolean 
     */
    public function getOpensource()
    {
        return $this->opensource;
    }

    /**
     * Set demo
     *
     * @param boolean $demo
     */
    public function setDemo($demo)
    {
        $this->demo = $demo;
    }

    /**
     * Get demo
     *
     * @return boolean 
     */
    public function getDemo()
    {
        return $this->demo;
    }

    /**
     * Set opensourcelicense
     *
     * @param string $opensourcelicense
     */
    public function setOpensourcelicense($opensourcelicense)
    {
        $this->opensourcelicense = $opensourcelicense;
    }

    /**
     * Get opensourcelicense
     *
     * @return string 
     */
    public function getOpensourcelicense()
    {
        return $this->opensourcelicense;
    }

    /**
     * Set category
     *
     * @param BoxConfig\ComponentBundle\Entity\SoftwareCategory $category
     */
    public function setCategory(\BoxConfig\ComponentBundle\Entity\SoftwareCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return BoxConfig\ComponentBundle\Entity\SoftwareCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
    public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add comments
     *
     * @param BoxConfig\ComponentBundle\Entity\Comment $comments
     */
    public function addComment(\BoxConfig\ComponentBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;
    }

    /**
     * Get comments
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add comments
     *
     * @param BoxConfig\ComponentBundle\Entity\SoftwareComment $comments
     */
    public function addSoftwareComment(\BoxConfig\ComponentBundle\Entity\SoftwareComment $comments)
    {
        $this->comments[] = $comments;
    }
}