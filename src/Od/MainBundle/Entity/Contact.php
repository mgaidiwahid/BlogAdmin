<?php

namespace Od\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;



use Symfony\Component\Validator\Mapping\ClassMetadata;


use Symfony\Component\Validator\Constraints\MinLength;


/**
 * @ORM\Entity
 * @ORM\Table(name="contact")
 */
 
class Contact
{
    
	
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
	/**
     * @ORM\Column(type="string")
     */
	protected $name;
    
	/**
     * @ORM\Column(type="string")
     */
    protected $email;

	/**
     * @ORM\Column(type="string")
     */
    protected $website;
    
	/**
     * @ORM\Column(type="text")
     */
	 
    protected $body;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
    }
	
	public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint('name', new NotBlank());

        $metadata->addPropertyConstraint('email', new Email());

        $metadata->addPropertyConstraint('website', new NotBlank());
        $metadata->addPropertyConstraint('website', new Length(array('min'=>5,'max'=>50))  );

        $metadata->addPropertyConstraint('body', new Length(array('min' => 50)));
    }
	
	
}