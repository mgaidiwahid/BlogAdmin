<?php

namespace Od\MainBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;



/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="Od\MainBundle\Repository\VideoRepository")
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;
	
	
	/**
     * @var string
	 *
     * @ORM\ManyToOne(targetEntity="Od\MainBundle\Entity\Image", cascade={"persist", "refresh"})
	 * @ORM\JoinColumn(nullable=false)
    */
    
    private $photo;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
	 
    private $status;
    
	/**
     * @var \datetime
	 * @ORM\Column(name="publicationDate", type="datetime")
     */
	private $publicationDate;
	
	/**
	 * @Gedmo\Slug(fields={"title"}, updatable=false, separator="_")
	 * @ORM\Column(length=255, unique=true)
	 */
	protected $slug;
	
	
	/**
     * @ORM\ManyToMany(targetEntity="Od\MainBundle\Entity\Tag", cascade={"persist", "refresh"})
     */
    private $tags;
	
	/**
     * @ORM\ManyToMany(targetEntity="Od\MainBundle\Entity\Category", cascade={"persist", "refresh"})
     */
    private $categories;
	
	public function __construct()
    {
        $this->publicationDate = new \DateTime();
		$this->categories = new ArrayCollection();
		$this->tags = new ArrayCollection();
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
	
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }
	
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }
    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
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
     * Set body
     *
     * @param string $body
     *
     * @return Post
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Post
     */
    public function setPhoto(Image $photo )
    {
        $this->photo = $photo;
		return $this;

    }
	
    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
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
	
	public function addCategory(Category $category){

    $this->categories[] = $category;
    return $this;
    }
	
	public function addTag(Tag $tag){

    $this->tags[] = $tag;
    return $this;
    }

	

    public function removeCategory(Category $category)
    {
		
    $this->categories->removeElement($category);
    }
	
	public function removeTag(Tag $tag)
    {
		
    $this->tags->removeElement($tag);
    }

  // Notez le pluriel, on récupère une liste de catégories ici !

    public function getCategories()
    {

    return $this->categories;

    }
	
	public function getTags()
    {

    return $this->tags;

    }
	
	
	public function getSlug()
    {
        return $this->slug;
    }



}

