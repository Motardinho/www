<?php

namespace Wmd\WatchMyDeskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\ExecutionContext;

/**
 * Desk
 *
 * @ORM\Table(name="desk")
 * @ORM\Entity(repositoryClass="Wmd\WatchMyDeskBundle\Repository\DeskRepository")
 * @UniqueEntity(fields="title", message="Ce titre de bureau existe déjà...")
 * @Assert\Callback(methods={"isContentCorrect"})
 */
class Desk
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
     * @var string $title
     * @Assert\NotBlank(message="Title must not be empty")
     * @Assert\MinLength(
     *      limit=3,
     *      message="Title should have at least {{ limit }} characters."
     * )
     * @Assert\MaxLength(255)
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var text $summary
     * @Assert\NotBlank()
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var text $description
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var decimal $note
     * @Assert\Min(limit="0", message="Desk's note must be positive")
     * @Assert\Max(limit="5", message="The max value for the note is 5")
     * @ORM\Column(name="note", type="decimal", nullable=true)
     */
    private $note;

    /**
     * @var integer $voteCount
     *
     * @ORM\Column(name="voteCount", type="integer", nullable=true)
     */
    private $voteCount;

    /**
     * @var datetime $createdAt
     * @Assert\DateTime()
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var datetime $updatedAt
     * @Assert\DateTime()
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_enabled", type="boolean")
     */
    private $isEnabled;
    
    /**
    * @ORM\OneToMany(targetEntity="DeskComment", mappedBy="desk", cascade={"remove", "persist"})
    */
    protected $comments;


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
     * Set title
     *
     * @param string $title
     * @return Desk
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Desk
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    
        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Desk
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
     * Set note
     *
     * @param float $note
     * @return Desk
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return float 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set voteCount
     *
     * @param integer $voteCount
     * @return Desk
     */
    public function setVoteCount($voteCount)
    {
        $this->voteCount = $voteCount;
    
        return $this;
    }

    /**
     * Get voteCount
     *
     * @return integer 
     */
    public function getVoteCount()
    {
        return $this->voteCount;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Desk
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Desk
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set isEnabled
     *
     * @param boolean $isEnabled
     * @return Desk
     */
    public function setIsEnabled($isEnabled)
    {
        $this->isEnabled = $isEnabled;
    
        return $this;
    }

    /**
     * Get isEnabled
     *
     * @return boolean 
     */
    public function getIsEnabled()
    {
        return $this->isEnabled;
    }
    
    public function __construct()
    {
        $this->voteCount = 0;
        $this->createdAt = new \DateTime('now');
        $this->isEnabled = false;
        
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add comments
     *
     * @param \Wmd\WatchMyDeskBundle\Entity\DeskComment $comments
     * @return Desk
     */
    public function addComment(\Wmd\WatchMyDeskBundle\Entity\DeskComment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Wmd\WatchMyDeskBundle\Entity\DeskComment $comments
     */
    public function removeComment(\Wmd\WatchMyDeskBundle\Entity\DeskComment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }
    
    /** 
     * Set comments
     * 
     * @param \Doctrine\Common\Collections\Collection $comments
     */
    public function setComment(\Doctrine\Common\Collections\Collection $comments)
    {
        $this->comments = $comments;
    }
    
    public function isContentCorrect(ExecutionContext $context)
    {
        $badWords = "#poule|poulette|cocotte#i"; // FDW FTW

        // Nous testons si nos propriétés contiennent ces mots reservés
        if (preg_match($badWords, $this->getTitle())) {
            $propertyPath = $context->getPropertyPath() . '.title';
            $context->addViolationAtSubPath($propertyPath, "Vous utilisez un mot réservé dans le titre !", array(), null); // On renvoi l'erreur au contexte
        }
        if (preg_match($badWords, $this->getDescription())) {
            $propertyPath = $context->getPropertyPath() . '.description';
            $context->addViolationAtSubPath($propertyPath, "Vous utilisez un mot réservé dans la description !", array(), null);
        }
    }
}