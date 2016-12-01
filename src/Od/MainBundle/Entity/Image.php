<?php

namespace Od\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;




/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="Od\MainBundle\Repository\PostRepository")
 */
 
class Image {
	
	
	const SERVER_PATH_TO_IMAGE_FOLDER = 'images';
	public $uploadPath = "images"; 
	

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
	 * Unmapped property to handle file uploads
		 * @var string
		 *
		 * @ORM\Column(name="file", type="string", length=255)

	 */
    protected $filename;
	
	protected $file;


	/**
     * @var \datetime
	 * @ORM\Column(name="updated", type="datetime")
     */
	protected $updated;
	
	
	/**
     * @var \string
	 * @ORM\Column(name="title", type="string", length=255)
     */
	protected $title;
	
	
	public function __construct()
    {
        $this->updated = new \DateTime();
		
    }
		
	public function getFilename()
    {
        return $this->filename;
    }
	
	 public function setFilename($filename)
    {
        $this->filename = $filename;
    }
	
	
	/**
	 * Sets file.
	 *
	 * @param UploadedFile $file
	 */
	
	

	/**
	 * Get file.
	 *
	 * @return UploadedFile
	 */
	public function getFile()
    {
        return $this->file;
    }

	public function setFile(UploadedFile $file = null)
	{
		$this->file = $file;
        $fileName = uniqid().'.'.$file->guessExtension();
        $file->move($this->getUploadRootDir(), $fileName);
        $this->path = $this->uploadPath;
        $this->filename = $fileName;
        $this->file = null;
	}
	
	public function getUploadRootDir()
    {
        return __DIR__."/../../../../web/".$this->uploadPath;
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
	
	public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }
	
    public function getTitle()
    {
        return $this->title;
    }
	/**
	 * Manages the copying of the file to the relevant place on the server
	 */
	public function upload()
	{
		// the file property can be empty if the field is not required
		if (null === $this->getFile()) {
			return;
		}

		// we use the original file name here but you should
		// sanitize it at least to avoid any security issues

		// move takes the target directory and target filename as params
		$this->getFile()->move(
			self::SERVER_PATH_TO_IMAGE_FOLDER,
			$this->getFile()->getClientOriginalName()
		);

		// set the path property to the filename where you've saved the file
		$this->filename = $this->getFile()->getClientOriginalName();

		// clean up the file property as you won't need it anymore
		$this->setFile(null);
	}

	/**
	 * Lifecycle callback to upload the file to the server
	 */
	public function lifecycleFileUpload()
	{
		$this->upload();
	}

	/**
	 * Updates the hash value to force the preUpdate and postUpdate events to fire
	 */
	public function refreshUpdated()
	{
		$this->setUpdated(new \DateTime());
	}
    public function getWebPath()
    {
        $webPath = "/".$this->uploadPath."/".$this->filename;
        return $webPath;
    }
	
	public function __toString(){
    return $this->filename;
    }

	
}
