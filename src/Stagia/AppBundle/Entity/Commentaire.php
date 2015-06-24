<?php

namespace Stagia\AppBundle\Entity;

/**
 * Commentaire
 */
class Commentaire
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $texte;
    
    /**
     * @var \Stagia\AppBundle\Entity\Sujet
     */
    private $sujet;

    /**
     * @var \Stagia\AppBundle\Entity\Utilisateur
     */
    private $utilisateur_createur;
    
    /**
     * @var \DateTime
     */
    private $date_creation;

    
    public function __constructor()
    {
        $this->date_creation = new \DateTime();
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
     * Set texte
     *
     * @param string $texte
     *
     * @return Commentaire
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set utilisateurCreateur
     *
     * @param \Stagia\AppBundle\Entity\Utilisateur $utilisateurCreateur
     *
     * @return Commentaire
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
     * Set sujet
     *
     * @param \Stagia\AppBundle\Entity\Sujet $sujet
     *
     * @return Commentaire
     */
    public function setSujet(\Stagia\AppBundle\Entity\Sujet $sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }

    /**
     * Get sujet
     *
     * @return \Stagia\AppBundle\Entity\Sujet
     */
    public function getSujet()
    {
        return $this->sujet;
    }
    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Commentaire
     */
    public function setDateCreation($dateCreation)
    {
        $this->date_creation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->date_creation;
    }
}
