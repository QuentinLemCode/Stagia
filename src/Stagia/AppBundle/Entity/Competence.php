<?php

namespace Stagia\AppBundle\Entity;

/**
 * Competence
 */
class Competence
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Competence
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stages;
    

    /**
     * Constructor
     */
    public function __construct($nom = null)
    {
        $this->stages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->nom = $nom;
    }
    

    

    /**
     * Add stage
     *
     * @param \Stagia\AppBundle\Entity\Stage $stage
     *
     * @return Competence
     */
    public function addStage(\Stagia\AppBundle\Entity\Stage $stage)
    {
        $this->stages[] = $stage;

        return $this;
    }

    /**
     * Remove stage
     *
     * @param \Stagia\AppBundle\Entity\Stage $stage
     */
    public function removeStage(\Stagia\AppBundle\Entity\Stage $stage)
    {
        $this->stages->removeElement($stage);
    }

    /**
     * Get stages
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStages()
    {
        return $this->stages;
    }
    
    public function __toString()
    {
        return $this->nom;
    }
}
