<?php

namespace Stagia\AppBundle\Entity;

/**
 * Memoire
 */
class Memoire
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
     * @var integer
     */
    private $annee;

    /**
     * @var \Stagia\AppBundle\Entity\Fichier
     */
    private $fichier;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commentaires;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Memoire
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
     * @return Memoire
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
     * @return Memoire
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
     * Set annee
     *
     * @param integer $annee
     *
     * @return Memoire
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee
     *
     * @return integer
     */
    public function getAnnee()
    {
        return $this->annee;
    }
    
    public function getStringAnnee()
    {
        return (string)($this->annee - 1).'/'.(string)$this->annee;
    }

    /**
     * Set fichier
     *
     * @param \Stagia\AppBundle\Entity\Fichier $fichier
     *
     * @return Memoire
     */
    public function setFichier(\Stagia\AppBundle\Entity\Fichier $fichier = null)
    {
        $this->fichier = $fichier;

        return $this;
    }

    /**
     * Get fichier
     *
     * @return \Stagia\AppBundle\Entity\Fichier
     */
    public function getFichier()
    {
        return $this->fichier;
    }

    /**
     * Add commentaire
     *
     * @param \Stagia\AppBundle\Entity\Commentaire $commentaire
     *
     * @return Memoire
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
     * Add fichier
     *
     * @param \Stagia\AppBundle\Entity\Fichier $fichier
     *
     * @return Memoire
     */
    public function addFichier(\Stagia\AppBundle\Entity\Fichier $fichier)
    {
        $this->fichier[] = $fichier;

        return $this;
    }

    /**
     * Remove fichier
     *
     * @param \Stagia\AppBundle\Entity\Fichier $fichier
     */
    public function removeFichier(\Stagia\AppBundle\Entity\Fichier $fichier)
    {
        $this->fichier->removeElement($fichier);
    }
    /**
     * @var \Stagia\UtilisateurBundle\Entity\Utilisateur
     */
    private $utilisateur_createur;


    /**
     * Set utilisateurCreateur
     *
     * @param \Stagia\UtilisateurBundle\Entity\Utilisateur $utilisateurCreateur
     *
     * @return Memoire
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
