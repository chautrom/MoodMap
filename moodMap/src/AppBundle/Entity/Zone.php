<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 */
class Zone
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $p1X;

    /**
     * @var int
     */
    private $p1Y;

    /**
     * @var int
     */
    private $p2X;

    /**
     * @var int
     */
    private $p2Y;


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
     * @return Zone
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
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
     * Set p1X
     *
     * @param float $p1X
     * @return Zone
     */
    public function setP1X($p1X)
    {
        $this->p1X = $p1X;

        return $this;
    }

    /**
     * Get p1X
     *
     * @return float 
     */
    public function getP1X()
    {
        return $this->p1X;
    }

    /**
     * Set p1Y
     *
     * @param float $p1Y
     * @return Zone
     */
    public function setP1Y($p1Y)
    {
        $this->p1Y = $p1Y;

        return $this;
    }

    /**
     * Get p1Y
     *
     * @return float 
     */
    public function getP1Y()
    {
        return $this->p1Y;
    }

    /**
     * Set p2X
     *
     * @param float $p2X
     * @return Zone
     */
    public function setP2X($p2X)
    {
        $this->p2X = $p2X;

        return $this;
    }

    /**
     * Get p2X
     *
     * @return float 
     */
    public function getP2X()
    {
        return $this->p2X;
    }

    /**
     * Set p2Y
     *
     * @param float $p2Y
     * @return Zone
     */
    public function setP2Y($p2Y)
    {
        $this->p2Y = $p2Y;

        return $this;
    }

    /**
     * Get p2Y
     *
     * @return float 
     */
    public function getP2Y()
    {
        return $this->p2Y;
    }
}
