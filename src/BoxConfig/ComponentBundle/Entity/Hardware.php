<?php

namespace BoxConfig\ComponentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\ComponentBundle\Entity\Hardware
 *
 * @ORM\Table(name="hardware")
 * @ORM\Entity(repositoryClass="BoxConfig\ComponentBundle\Repository\HardwareRepository")
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

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    public $description;

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
        return '/uploads/hardware';
    }


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
}