<?php

namespace Stagia\AppBundle\Entity;

/**
 * Sujet
 */
class Sujet
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nom = '';

    /**
     * @var string
     */
    private $description;

    /**
     * @var \DateTime
     */
    private $date_creation;

    /**
     * @var boolean
     */
    private $validation = false;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Sujet
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
     * Set description
     *
     * @param string $description
     *
     * @return Sujet
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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Sujet
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

    /**
     * Set validation
     *
     * @param boolean $validation
     *
     * @return Sujet
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;

        return $this;
    }

    /**
     * Get validation
     *
     * @return boolean
     */
    public function getValidation()
    {
        return $this->validation;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commentaires;

    /**
     * @var \Stagia\UtilisateurBundle\Entity\Utilisateur
     */
    private $utilisateur_createur;



    /**
     * Add commentaire
     *
     * @param \Stagia\AppBundle\Entity\Commentaire $commentaire
     *
     * @return Sujet
     */
    public function addCommentaire(\Stagia\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Stagia\AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\Stagia\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set utilisateurCreateur
     *
     * @param \Stagia\UtilisateurBundle\Entity\Utilisateur $utilisateurCreateur
     *
     * @return Sujet
     */
    public function setUtilisateurCreateur(\Stagia\UtilisateurBundle\Entity\Utilisateur $utilisateurCreateur)
    {
        $this->utilisateur_createur = $utilisateurCreateur;

        return $this;
    }

    /**
     * Get utilisateurCreateur
     *
     * @return \Stagia\UtilisateurBundle\Entity\Utilisateur
     */
    public function getUtilisateurCreateur()
    {
        return $this->utilisateur_createur;
    }
}
