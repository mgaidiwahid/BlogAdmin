<?php

namespace Od\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Category
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="Od\MainBundle\Repository\CategoryRepository")
 * @ORM\HasLifeCycleCallbacks()
 */
class Category
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Gedmo\Translatable
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

	
   /**
    * @ORM\OneToMany(targetEntity="Post", mappedBy="category")
    */
    private $Posts;
	
	
    /**
     * @Gedmo\TreeRoot
     * @ORM\Column(type="integer", nullable=true)
     */
    private $root;
	
	/**
    * @Gedmo\TreeLeft
    * @ORM\Column(name="lft", type="integer", nullable=true)
    */
    private $lft;
	
    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(name="lvl",type="integer", nullable=true)
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(name="rgt",type="integer", nullable=true)
     */
    private $rgt;

    /**
    * @Gedmo\TreeParent
    * @ORM\ManyToOne(targetEntity="Category", inversedBy="children")
    * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="CASCADE")
    */
    private $parent;
   
    /**
	* 
    * @ORM\OneToMany(targetEntity="Category", mappedBy="parent")
    * @ORM\OrderBy({"lft" = "ASC"})
    */
    private $children;
	
	
	/**
	* @Gedmo\SortablePosition
	*@ORM\Column(name="position", type="integer", nullable=false) 
	*/ 
	private $position;
	
	/**
	 * @Gedmo\Slug(fields={"name"}, updatable=false, separator="_")
	 * @ORM\Column(length=255, unique=true)
	 */
	protected $slug;

	/**
     * @var string
     *
	 *@ORM\ManyToOne(targetEntity="Od\MainBundle\Entity\Image", cascade={"persist", "refresh"})
	 *@ORM\JoinColumn(nullable=false)
    */
    
    private $photo;
	
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
     * @ORM\PrePersist
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
		
		/*
        if ($this->getParent() != null){
			echo($this->getParent());
	    	  parent::__construct();
	    	  $this->lvl = parent::getLvl() + 1;
	    	  $this->root = parent::getRoot();
	     }
	     else {
	    	  $this->lvl = 0;
	     }*/
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Category
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
     * Set status
     *
     * @param boolean $status
     *
     * @return Category
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
	
	public function setParent(Category $parent=null)
    {
        $this->parent = $parent;

    }
	public function getParent()
    {
        return $this->parent;
    }

	
    /**
     * Add child
     *
     * @param \Od\MainBundle\Entity\Category $child
     *
     * @return Category
     */
    public function addChild($children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Od\MainBundle\Entity\Category $child
     */
    public function removeChild($children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

	
	/**
	*Position
	*/
	public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }
	public function getPosition()
    {
        return $this->position;
    }
	
	/**
     * Set lft
     *
     * @param integer $lft
     */
    public function setLft($lft)
    {
        $this->lft = $lft;
		return $this;
    }

    /**
     * Get lft
     *
     * @return integer 
     */
    public function getLft()
    {
        return $this->lft;
    }
    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Category
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return Category
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

	
	    /**
     * Set root
     *
     * @param integer $root
     */
    public function setRoot( $root)
    {
        $this->root = $root;
		return $this;
    }

    /**
     * Get root
     *
     * @return integer 
     */
    public function getRoot()
    {
        return $this->root;
    }

	
	public function getSlug()
	{
		return $this->slug;
	}

	public function setSlug($slug)
	{
		$this->slug = $slug;
	}

	public function __toString()
    {
        $prefix = "";
        for ($i=2; $i<= $this->lft; $i++){
            $prefix .= "& nbsp;& nbsp;& nbsp;& nbsp;";
        }
        return $prefix . $this->name;
    }
}

