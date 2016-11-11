<?php
namespace Od\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;



class ImageAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {

        $formMapper->add('title');
        $formMapper->add('filename', 'file',array('required' => false,
            'data_class' => 'Symfony\Component\HttpFoundation\File\File',
            'property_path' => 'file')
        );
		$formMapper->add('updated');
		
    }
    
	protected function configureListFields(ListMapper $listMapper)
    {
		
		$listMapper->addIdentifier('title');
		
        $listMapper->addIdentifier('filename',null, array(
                'template' => 'OdMainBundle:Admin:image_preview_list.html.twig'
            ));
		
		$listMapper->add('updated');

    }
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {

        $datagridMapper->add('title');
    }
    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image)
    {
        if ($image->getFile()) {
            $image->refreshUpdated();
        }
    }
	
	public function toString($object)
    {
        return $object->getTitle();
           
    }
    
}