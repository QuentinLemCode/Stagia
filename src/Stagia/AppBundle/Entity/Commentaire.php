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
    private $titre;

    /**
     * @var string
     */
    private $texte;

    /**
     * @var \Stagia\AppBundle\Entity\Utilisateur
     */
    private $utilisateur_createur;


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
     * @return Commentaire
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
    public function setUtilisateurCreateur(\Stagia\AppBundle\Entity\Utilisateur $utilisateurCreateur)
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
     * @var \Stagia\UtilisateurBundle\Entity\Utilisateur
     */
    private $utilisateurcreateur;


    /**
     * @var \Stagia\AppBundle\Entity\Sujet
     */
    private $sujet;


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
     * @var \DateTime
     */
    private $date_creation;


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
