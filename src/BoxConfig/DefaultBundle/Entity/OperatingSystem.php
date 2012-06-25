<?php

namespace BoxConfig\DefaultBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * BoxConfig\DefaultBundle\Entity\OperatingSystem
 *
 * @ORM\Table(name="operatingsystem")
 * @ORM\Entity
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
     * @ORM\Column(type="string", length="255")
     */
    protected $distribution;

    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $version;

    /**
     * @ORM\Column(type="string", length="255")
     */
    protected $codename;



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