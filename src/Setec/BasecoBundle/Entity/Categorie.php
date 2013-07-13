<?php

namespace Setec\BasecoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="baseco_categorie")
 * @ORM\Entity(repositoryClass="Setec\BasecoBundle\Entity\CategorieRepository")
 */
class Categorie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="id_parent", referencedColumnName="id")
     */
    private $parent;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;


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
     * Set idParent
     *
     * @param integer $idParent
     * @return Categorie
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;
    
        return $this;
    }

    /**
     * Get idParent
     *
     * @return integer 
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Categorie
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
     * Set parent
     *
     * @param \Setec\BasecoBundle\Entity\Categorie $parent
     * @return Categorie
     */
    public function setParent(\Setec\BasecoBundle\Entity\Categorie $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Setec\BasecoBundle\Entity\Categorie 
     */
    public function getParent()
    {
        return $this->parent;
    }
}