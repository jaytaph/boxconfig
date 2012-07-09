<?php

namespace BoxConfig\ComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\ComponentBundle\Entity\OperatingSystem
 *
 * @ORM\Table(name="operatingSystem")
 * @ORM\Entity(repositoryClass="BoxConfig\ComponentBundle\Repository\OperatingSystemRepository")
 * @ORM\HasLifecycleCallbacks
 */
class OperatingSystem
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
    protected $os;

    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $distribution;

    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $version;

    /**
     * @ORM\Column(type="string", length="255", nullable=true)
     */
    protected $codename;

    /**
     * @ORM\OneToMany(targetEntity="BoxConfig\ComponentBundle\Entity\OperatingSystemComment", mappedBy="operatingsystem")
     */
    protected $comments;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $imagePath;

    public function getWebThumbPath($height, $width) {
        return null === $this->imagePath ? null :  $this->getUploadDir() . "/thumb-".$height."-".$width."/".$this->imagePath;
    }

    public function getAbsolutePath()
    {
        return null === $this->imagePath ? null : $this->getUploadRootDir().'/'.$this->imagePath;
    }

    public function getWebPath()
    {
        return null === $this->imagePath ? null : $this->getUploadDir().'/'.$this->imagePath;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return '/uploads/operatingsystem';
    }



    function __toString() {
        $os = $this->os;

        $tmp = $this->getDistribution();
        if (! empty($tmp)) $os .= " " . $tmp;

        $tmp = $this->getVersion();
        if (! empty($tmp)) $os .= " " . $tmp;

        $tmp = $this->getCodename();
        if (! empty($tmp)) $os .= " (" . $tmp .")";

        return $os;
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
     * Set os
     *
     * @param string $os
     */
    public function setOs($os)
    {
        $this->os = $os;
    }

    /**
     * Get os
     *
     * @return string 
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Set distribution
     *
     * @param string $distribution
     */
    public function setDistribution($distribution)
    {
        $this->distribution = $distribution;
    }

    /**
     * Get distribution
     *
     * @return string 
     */
    public function getDistribution()
    {
        return $this->distribution;
    }

    /**
     * Set version
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * Get version
     *
     * @return string 
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set codename
     *
     * @param string $codename
     */
    public function setCodename($codename)
    {
        $this->codename = $codename;
    }

    /**
     * Get codename
     *
     * @return string 
     */
    public function getCodename()
    {
        return $this->codename;
    }

    /**
     * Set imagePath
     *
     * @param string $imagePath
     */
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    /**
     * Get imagePath
     *
     * @return string 
     */
    public function getImagePath()
    {
        return $this->imagePath;
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
     * @param BoxConfig\ComponentBundle\Entity\OperatingSystemComment $comments
     */
    public function addOperatingSystemComment(\BoxConfig\ComponentBundle\Entity\OperatingSystemComment $comments)
    {
        $this->comments[] = $comments;
    }
}