<?php

namespace Setec\AffelecBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Setec\AffelecBundle\Entity\Tag;

/**
 * Fichier
 *
 * @ORM\Table(name="Affelec_fichier")
 * @ORM\Entity(repositoryClass="Setec\AffelecBundle\Entity\FichierRepository")
 */
class Fichier
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_ajout", type="datetime")
     */
    private $dateAjout;

    /**
     * @var string
     *
     * @ORM\Column(name="affaire", type="string", length=12)
     */
    private $affaire;

    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=8)
     */
    private $matricule;

    /**
     * @ORM\OneToOne(targetEntity="Setec\AffelecBundle\Entity\Categorie")
     */
    private $categorie;

    /**
     * @ORM\ManyToMany(targetEntity="Setec\AffelecBundle\Entity\Tag")
     * @ORM\JoinTable(name="Affelec_fichier_tag")
     */
    private $tags;

    public function __construct()
    {
        $this->dateAjout = new \DateTime();
        $this->tags = new ArrayCollection();
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
     * @return Fichier
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
     * @return Fichier
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
     * Set dateAjout
     *
     * @param \DateTime $dateAjout
     * @return Fichier
     */
    public function setDateAjout(\DateTime $dateAjout)
    {
        $this->dateAjout = $dateAjout;
    
        return $this;
    }

    /**
     * Get dateAjout
     *
     * @return \DateTime 
     */
    public function getDateAjout()
    {
        return $this->dateAjout;
    }

    /**
     * Set affaire
     *
     * @param string $affaire
     * @return Fichier
     */
    public function setAffaire($affaire)
    {
        $this->affaire = $affaire;
    
        return $this;
    }

    /**
     * Get affaire
     *
     * @return string 
     */
    public function getAffaire()
    {
        return $this->affaire;
    }

    /**
     * Set matricule
     *
     * @param string $matricule
     * @return Fichier
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;
    
        return $this;
    }

    /**
     * Get matricule
     *
     * @return string 
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set categorie
     *
     * @param \Setec\AffelecBundle\Entity\Categorie $categorie
     * @return Fichier
     */
    public function setCategorie(\Setec\AffelecBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;
    
        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Setec\AffelecBundle\Entity\Categorie 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Add tags
     *
     * @param \Setec\AffelecBundle\Entity\Tag $tags
     * @return Fichier
     */
    public function addTag(\Setec\AffelecBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Setec\AffelecBundle\Entity\Tag $tags
     */
    public function removeTag(\Setec\AffelecBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        return $this->tags;
    }
}