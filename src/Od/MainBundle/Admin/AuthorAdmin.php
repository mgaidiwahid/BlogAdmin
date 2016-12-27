<?php

namespace Od\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;


class AuthorAdmin extends AbstractAdmin
{
	
	
	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper->add('libelle', 'text');
		$formMapper->add('tags', 'sonata_type_model', array(
            'class' => 'Od\MainBundle\Entity\Tag',
            'property' => 'name',
			'multiple' => true,
        ));
		$formMapper->add('body','textarea', array('attr' => array('class' => 'ckeditor')));
		
		$formMapper->add('categories', 'sonata_type_model', array(
            'class' => 'Od\MainBundle\Entity\Category',
            'property' => 'name',
			'multiple' => true,
        ));
        $formMapper->add('publicationDate');
		
		/*$formMapper->add('photo', 'sonata_type_model', array(
            'class' => 'Od\MainBundle\Entity\Image',
            'property' => 'title',
        ));*/
        $formMapper->add('photo', 'sonata_type_model_list', array(
                    'btn_add'       => 'Add Photo',      //Specify a custom label
                    'btn_list'      => 'photo.list',     //which will be translated
                    'btn_delete'    => false,             //or hide the button.
                    'btn_catalogue' => 'SonataNewsBundle' //Custom translation domain for buttons
                ), array(
                    'placeholder' => 'No Photo selected'
                ));
		
		$formMapper->add('photo2', 'sonata_type_model_list', array(
                    'btn_add'       => 'Add Photo',      //Specify a custom label
                    'btn_list'      => 'photo.list',     //which will be translated
                    'btn_delete'    => false,             //or hide the button.
                    'btn_catalogue' => 'SonataNewsBundle' //Custom translation domain for buttons
                ), array(
                    'placeholder' => 'No Photo selected'
                ));
		
		
		$formMapper->add('status', 'sonata_type_choice_field_mask', array(
                'choices' => array(
                    '1' => 'actif',
                    '0' => 'inactif',
                )
				));
		
        
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('title');
		$datagridMapper->add('categories', null, array(), 'entity', array(
                'class'    => 'Od\MainBundle\Entity\Category',
                'property' => 'name',
            ));
		
        $datagridMapper->add('status');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('title');
		$listMapper->add('category.name');
		$listMapper->add('status');
    }
	

   
	
	public function toString($object)
    {
       /* return $object instanceof Post
            ? $object->getTitle()
            : 'Blog Post'; // shown in the breadcrumb on the create view*/
		return	$object->getTitle();
    }
	
	
	public function __toString()
    {
        $prefix = "";
        for ($i=2; $i<= $this->lft; $i++){
            $prefix .= "& nbsp;& nbsp;& nbsp;& nbsp;";
        }
        return $prefix . $this->title;
    }
	
	
	
	
}



?>