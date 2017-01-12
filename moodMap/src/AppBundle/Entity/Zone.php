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
     * @var float
     */
    private $x;

    /**
     * @var float
     */
    private $y;

    /**
     * @var float
     */
    private $r;

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
     * Get x
     *
     * @return float 
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set x
     *
     * @param float $x
     * @return Zone
     */
    public function setX($X)
    {
        $this->x = $X;

        return $this;
    }

    /**
     * Get y
     *
     * @return float 
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set y
     *
     * @param float $Y
     * @return Zone
     */
    public function setY($Y)
    {
        $this->y = $Y;

        return $this;
    }

    /**
     * Get r
     *
     * @return float 
     */
    public function getR()
    {
        return $this->r;
    }

    /**
     * Set y
     *
     * @param float $R
     * @return Zone
     */
    public function setR($R)
    {
        $this->r = $R;

        return $this;
    }
    
}
