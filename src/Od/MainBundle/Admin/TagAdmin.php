<?php
namespace Od\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;



class TagAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper->add('name');
		$formMapper->add('status');
		$formMapper->add('updated');
		
    }
    
	protected function configureListFields(ListMapper $listMapper)
    {
		
		$listMapper->addIdentifier('name');	
		$listMapper->add('updated');
		$listMapper->add('status');

    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $datagridMapper->add('name');
		$datagridMapper->add('status');
    }

	
	public function toString($object)
    {
        return $object instanceof Tag
            ? $object->getName()
            : 'Tag'; // shown in the breadcrumb on the create view
    }
    
}