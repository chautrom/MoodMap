<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vote
 */
class Vote
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $idUser;

    /**
     * @var int
     */
    private $idCriteria;

    /**
     * @var int
     */
    private $idDatazone;

    /**
     * @var string
     */
    private $score;


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
     * Set idUser
     *
     * @param integer $idUser
     * @return Vote
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer 
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idCriteria
     *
     * @param integer $idCriteria
     * @return Vote
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

    /**
     * Set idDatazone
     *
     * @param integer $idDatazone
     * @return Vote
     */
    public function setIdDatazone($idDatazone)
    {
        $this->idDatazone = $idDatazone;

        return $this;
    }

    /**
     * Get idDatazone
     *
     * @return integer 
     */
    public function getIdDatazone()
    {
        return $this->idDatazone;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return Vote
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore()
    {
        return $this->score;
    }
}
