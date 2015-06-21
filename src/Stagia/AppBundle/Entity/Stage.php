<?php

namespace Stagia\AppBundle\Entity;

use Symfony\Component\Validator\ExecutionContextInterface;
/**
 * Stage
 */
class Stage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titre = '';

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $date_debut;

    /**
     * @var \DateTime
     */
    private $date_fin;

    /**
     * @var string
     */
    private $competences;

    /**
     * @var \DateTime
     */
    private $date_publication;

    /**
     * @var string
     */
    private $lieu;

    /**
     * @var integer
     */
    private $remuneration = 0;

    /**
     * @var boolean
     */
    private $conventionDeStage;

    /**
     * @var boolean
     */
    private $active = true;

    /**
     * @var \Stagia\AppBundle\Entity\Utilisateur
     */
    private $utilisateur_createur;

    public function __constructor()
    {
        $this->active = true;
        $this->competences = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titre
     *
     * @param string $titre
     *
     * @return Stage
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Stage
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Stage
     */
    public function setDateDebut($dateDebut)
    {
        $this->date_debut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Stage
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }



    /**
     * Set datePublication
     *
     * @param \DateTime $datePublication
     *
     * @return Stage
     */
    public function setDatePublication($datePublication)
    {
        $this->date_publication = $datePublication;

        return $this;
    }

    /**
     * Get datePublication
     *
     * @return \DateTime
     */
    public function getDatePublication()
    {
        return $this->date_publication;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Stage
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set remuneration
     *
     * @param integer $remuneration
     *
     * @return Stage
     */
    public function setRemuneration($remuneration)
    {
        $this->remuneration = $remuneration;

        return $this;
    }

    /**
     * Get remuneration
     *
     * @return integer
     */
    public function getRemuneration()
    {
        return $this->remuneration;
    }

    /**
     * Set conventionDeStage
     *
     * @param boolean $conventionDeStage
     *
     * @return Stage
     */
    public function setConventionDeStage($conventionDeStage)
    {
        $this->conventionDeStage = $conventionDeStage;

        return $this;
    }

    /**
     * Get conventionDeStage
     *
     * @return boolean
     */
    public function getConventionDeStage()
    {
        return $this->conventionDeStage;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Stage
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set utilisateurCreateur
     *
     * @param \Stagia\AppBundle\Entity\Utilisateur $utilisateurCreateur
     *
     * @return Stage
     */
    public function setUtilisateurCreateur(\Stagia\UtilisateurBundle\Entity\Utilisateur $utilisateurCreateur)
    {
        $this->utilisateur_createur = $utilisateurCreateur;

        return $this;
    }

    /**
     * Get utilisateurCreateur
     *
     * @return \Stagia\AppBundle\Entity\Utilisateur
     */
    public function getUtilisateurCreateur()
    {
        return $this->utilisateur_createur;
    }
    /**
     * Get competences
     *
     * @return string
     */
    public function getCompetences()
    {
        return $this->competences;
    }

    /**
     * Set competences
     *
     * @param string $competences
     *
     * @return Stage
     */
    public function setCompetences($competences)
    {
        $this->competences = $competences;

        return $this;
    }
    
    public function validate(ExecutionContextInterface $context)
    {
        if($this->getDateDebut() != null && $this->getDateFin() != null)
        {
            if($this->getDateFin() < $this->getDateDebut())
            {
                $context->addViolationAt(
                        'dateFin', 
                        'La date de fin de stage ne peut pas être avant le début du stage'
                );
            }
            else if($this->getDateFin() == $this->getDateDebut())
            {
                $context->addViolationAt(
                        'dateFin',
                        'La date de fin de stage ne peut pas être le même jour que le début du stage'
                ); 
            }
        }
    }
}
