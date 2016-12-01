<?php

namespace Od\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="Od\MainBundle\Repository\PostRepository")
 */
class Post
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
     * @var string
     * @ORM\ManyToOne(targetEntity="Od\MainBundle\Entity\Image", cascade={"persist", "refresh"})
	 * ORM\JoinColumn(nullable=false)
    */
    
    private $photo2;

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
     * @ORM\ManyToMany(targetEntity="Od\MainBundle\Entity\Category", cascade={"persist", "refresh"})
     */
    private $categories;
	
	/**
     * @ORM\ManyToMany(targetEntity="Od\MainBundle\Entity\Tag", cascade={"persist", "refresh"})
     */
    private $tags;
	
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

	public function setPhoto2(Image $photo2 )
    {
        $this->photo2 = $photo2;
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
	
	public function getPhoto2()
    {
        return $this->photo2;
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
	/**
 * Manages the copying of the file to the relevant place on the server
 */
	public function upload()
	{
    // the file property can be empty if the field is not required
    if (null === $this->getPhoto()) {
        return;
    }

    // we use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and target filename as params
    $this->getPhoto()->move(
        Image::SERVER_PATH_TO_IMAGE_FOLDER,
        $this->getPhoto()->getClientOriginalName()
    );

    // set the path property to the filename where you've saved the file
    $this->filename = $this->getPhoto()->getClientOriginalName();

    // clean up the file property as you won't need it anymore
    $this->setPhoto(null);
}

/**
 * Lifecycle callback to upload the file to the server
 */
	public function lifecycleFileUpload() {
		$this->upload();
	}

/**
 * Updates the hash value to force the preUpdate and postUpdate events to fire
 */
	public function refreshUpdated() {
		$this->setUpdated(new \DateTime("now"));
	}


}

