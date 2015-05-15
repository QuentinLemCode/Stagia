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
     * @var number
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
     * @param \number $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone(\number $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return \number
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
}
