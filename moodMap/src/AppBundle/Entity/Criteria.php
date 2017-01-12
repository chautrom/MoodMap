<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Criteria
 */
class Criteria
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
     * @var string
     */
    private $iconpath;


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
     * @return Criteria
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
     * Set iconpath
     *
     * @param string $iconpath
     * @return Criteria
     */
    public function setIconpath($iconpath)
    {
        $this->iconpath = $iconpath;

        return $this;
    }

    /**
     * Get iconpath
     *
     * @return string 
     */
    public function getIconpath()
    {
        return $this->iconpath;
    }
}
