<?php

namespace BoxConfig\BoxBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\BoxBundle\Entity\OperatingSystem
 *
 * @ORM\Table(name="operatingSystem")
 * @ORM\Entity(repositoryClass="BoxConfig\BoxBundle\Repository\OperatingSystemRepository")
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
}