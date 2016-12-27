<?php

namespace Od\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;




/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="Od\MainBundle\Repository\TagRepository")
 */
 
class Tag {
	
	

	

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;
	
	
	/**
     * @var \datetime
	 * @ORM\Column(name="updated", type="datetime")
     */
	protected $updated;
	
	
	/**
     * @var \string
	 * @ORM\Column(name="name", type="string", length=255)
     */
	protected $name;
		

	/**
	 * @Gedmo\Slug(fields={"name"}, updatable=false, separator="_")
	 * @ORM\Column(length=255, unique=true)
	 */
	protected $slug;
	
	/**
     * @var bool
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

	 /**
     * @ORM\ManyToMany(targetEntity="Od\MainBundle\Entity\Post", cascade={"persist", "refresh"})
	 * @ORM\JoinTable(name="post_tag")
     */
	 
    private $posts;
	
    public function __construct()
    {
        $this->updated = new \DateTime();
		
    }
	
	
	
	public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }
	
    public function getUpdated()
    {
        return $this->updated;
    }
	
	public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
	
    public function getName()
    {
        return $this->name;
    }
	
	    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }
	
	public function refreshUpdated() {
		$this->setUpdated(new \DateTime("now"));
	}
	public function getPosts()
    {

    return $this->posts;

    }
}
