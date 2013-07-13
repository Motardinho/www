<?php

namespace Wmd\WatchMyDeskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DeskComment
 *
 * @ORM\Table(name="desk_comment")
 * @ORM\Entity(repositoryClass="Wmd\WatchMyDeskBundle\Repository\DeskCommentRepository")
 */
class DeskComment
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="submission_ip", type="string", length=32)
     */
    private $submissionIp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;
    
    /**
    * @ORM\ManyToOne(targetEntity="Desk", inversedBy="comments", cascade={"remove"})
    * @ORM\JoinColumn(name="desk_id", referencedColumnName="id")
    */
    protected $desk;
    
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
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
     * Set description
     *
     * @param string $description
     * @return DeskComment
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
     * Set submissionIp
     *
     * @param string $submissionIp
     * @return DeskComment
     */
    public function setSubmissionIp($submissionIp)
    {
        $this->submissionIp = $submissionIp;
    
        return $this;
    }

    /**
     * Get submissionIp
     *
     * @return string 
     */
    public function getSubmissionIp()
    {
        return $this->submissionIp;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return DeskComment
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
     * Set desk
     *
     * @param \Wmd\WatchMyDeskBundle\Entity\Desk $desk
     * @return DeskComment
     */
    public function setDesk(\Wmd\WatchMyDeskBundle\Entity\Desk $desk = null)
    {
        $this->desk = $desk;
    
        return $this;
    }

    /**
     * Get desk
     *
     * @return \Wmd\WatchMyDeskBundle\Entity\Desk 
     */
    public function getDesk()
    {
        return $this->desk;
    }
}