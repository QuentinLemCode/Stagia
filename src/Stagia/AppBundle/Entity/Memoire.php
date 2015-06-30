<?php

namespace Stagia\AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;

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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commentaires;
    
    /**
     * @var string
     */
    private $cheminFichier;
    /**
     * Fichier
     */
    protected $file;
    /**
     * Fichier
     */
    private $fileRemove;
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
    
    public function setFile(File $file = null)
    {
        $this->file = $file;
        return $this;
    }
    
    public function getFile()
    {
        return $this->file;
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
    public function setUtilisateurCreateur($utilisateurCreateur)
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
    
    public function getCheminFichier()
    {
        return $this->cheminFichier;
    }
    
    public function setCheminFichier($cheminFichier = null)
    {
        $this->cheminFichier = $cheminFichier;
        return $this;
    }
    
    public function preUpload()
    {
        if (null !== $this->file) {
            $this->cheminFichier = '.'.$this->file->guessExtension();
        }
    }
    
    public function upload()
    {
        if (null === $this->file) {
            return;
        }
        $this->file->move($this->getUploadRootDir(), $this->id.'.'.$this->file->guessExtension());

        unset($this->file);
    }
    
    public function preRemoveUpload()
    {
        $this->fileRemove = $this->getAbsolutePath();
    }
    
    public function postRemoveUpload()
    {
        if ($this->fileRemove) {
            unlink($this->fileRemove);
        }
        $this->cheminFichier = null;
    }

    public function getAbsolutePath()
    {
        return null === $this->cheminFichier ? null : $this->getUploadRootDir().'/'.$this->id.$this->cheminFichier;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/memoires';
    }
    
    public function getFileName()
    {
        return htmlspecialchars(trim($this->nom)).$this->cheminFichier;
    }
    
    public function isMemoireExist()
    {
        if($this->getCheminFichier() != null) {
            return true;
        }
        return false;
    }
}
