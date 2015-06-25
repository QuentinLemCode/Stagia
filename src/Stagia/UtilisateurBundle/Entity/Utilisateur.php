<?php
namespace Stagia\UtilisateurBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

class Utilisateur extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $rue;

    /**
     * @var string
     */
    private $adresse1;

    /**
     * @var string
     */
    private $adresse2;

    /**
     * @var string
     */
    private $codepostal;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var string
     */
    private $telephone;


    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set rue
     *
     * @param string $rue
     *
     * @return Utilisateur
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set adresse1
     *
     * @param string $adresse1
     *
     * @return Utilisateur
     */
    public function setAdresse1($adresse1)
    {
        $this->adresse1 = $adresse1;

        return $this;
    }

    /**
     * Get adresse1
     *
     * @return string
     */
    public function getAdresse1()
    {
        return $this->adresse1;
    }

    /**
     * Set adresse2
     *
     * @param string $adresse2
     *
     * @return Utilisateur
     */
    public function setAdresse2($adresse2)
    {
        $this->adresse2 = $adresse2;

        return $this;
    }

    /**
     * Get adresse2
     *
     * @return string
     */
    public function getAdresse2()
    {
        return $this->adresse2;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     *
     * @return Utilisateur
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Utilisateur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set telephone
     *
     * @param \string $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return \string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $stage;


    /**
     * Add stage
     *
     * @param \Stagia\AppBundle\Entity\Stage $stage
     *
     * @return Utilisateur
     */
    public function addStage(\Stagia\AppBundle\Entity\Stage $stage)
    {
        $this->stage[] = $stage;

        return $this;
    }

    /**
     * Remove stage
     *
     * @param \Stagia\AppBundle\Entity\Stage $stage
     */
    public function removeStage(\Stagia\AppBundle\Entity\Stage $stage)
    {
        $this->stage->removeElement($stage);
    }

    /**
     * Get stage
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStage()
    {
        return $this->stage;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $commentaire;


    /**
     * Add commentaire
     *
     * @param \Stagia\AppBundle\Entity\Commentaire $commentaire
     *
     * @return Utilisateur
     */
    public function addCommentaire(\Stagia\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \Stagia\AppBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\Stagia\AppBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaire->removeElement($commentaire);
    }

    /**
     * Get commentaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $memoire;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $sujet;


    /**
     * Add memoire
     *
     * @param \Stagia\AppBundle\Entity\Memoire $memoire
     *
     * @return Utilisateur
     */
    public function addMemoire(\Stagia\AppBundle\Entity\Memoire $memoire)
    {
        $this->memoire[] = $memoire;

        return $this;
    }

    /**
     * Remove memoire
     *
     * @param \Stagia\AppBundle\Entity\Memoire $memoire
     */
    public function removeMemoire(\Stagia\AppBundle\Entity\Memoire $memoire)
    {
        $this->memoire->removeElement($memoire);
    }

    /**
     * Get memoire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMemoire()
    {
        return $this->memoire;
    }

    /**
     * Add sujet
     *
     * @param \Stagia\AppBundle\Entity\Sujet $sujet
     *
     * @return Utilisateur
     */
    public function addSujet(\Stagia\AppBundle\Entity\Sujet $sujet)
    {
        $this->sujet[] = $sujet;

        return $this;
    }

    /**
     * Remove sujet
     *
     * @param \Stagia\AppBundle\Entity\Sujet $sujet
     */
    public function removeSujet(\Stagia\AppBundle\Entity\Sujet $sujet)
    {
        $this->sujet->removeElement($sujet);
    }

    /**
     * Get sujet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSujet()
    {
        return $this->sujet;
    }
}
