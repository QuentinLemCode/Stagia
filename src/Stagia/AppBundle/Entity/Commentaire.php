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
}
