<?php

namespace Setec\SalarieBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
* @ORM\Table(name="setec_salarie")
* @ORM\Entity(repositoryClass="Setec\SalarieBundle\Entity\SalarieRepository")
*/
class Salarie extends BaseUser
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
     * @ORM\Column(type="string", length=255)
     */
	private $nom;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $prenom;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $trigramme;

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
     * @return Salarie
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
     * @return Salarie
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
     * Set matricule
     *
     * @param string $matricule
     * @return Salarie
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
     * Set trigramme
     *
     * @param string $trigramme
     * @return Salarie
     */
    public function setTrigramme($trigramme)
    {
        $this->trigramme = $trigramme;
    
        return $this;
    }

    /**
     * Get trigramme
     *
     * @return string 
     */
    public function getTrigramme()
    {
        return $this->trigramme;
    }
}