<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Datazone
 */
class Datazone
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var float
     */
    private $score;

    /**
     * @var int
     */
    private $idZone;

    /**
     * @var int
     */
    private $idCriteria;


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
     * Set score
     *
     * @param float $score
     * @return Datazone
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return float 
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set idZone
     *
     * @param integer $idZone
     * @return Datazone
     */
    public function setIdZone($idZone)
    {
        $this->idZone = $idZone;

        return $this;
    }

    /**
     * Get idZone
     *
     * @return integer 
     */
    public function getIdZone()
    {
        return $this->idZone;
    }

    /**
     * Set idCriteria
     *
     * @param integer $idCriteria
     * @return Datazone
     */
    public function setIdCriteria($idCriteria)
    {
        $this->idCriteria = $idCriteria;

        return $this;
    }

    /**
     * Get idCriteria
     *
     * @return integer 
     */
    public function getIdCriteria()
    {
        return $this->idCriteria;
    }
}
