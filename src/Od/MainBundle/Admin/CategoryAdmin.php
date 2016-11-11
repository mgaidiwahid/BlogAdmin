<?php

namespace Od\MainBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Sonata\AdminBundle\Route\RouteCollection;

use Sonata\DoctrineORMAdminBundle\Datagrid\ProxyQuery;



class CategoryAdmin extends AbstractAdmin
{
	 public $last_position = 0;

	 private $container;
	 private $positionService;

	 public function setContainer(\Symfony\Component\DependencyInjection\ContainerInterface $container)
	 {
		 $this->container = $container;
	 }

    protected $datagridValues = array(
        '_page' => 1,
        '_sort_by' => 'root',
        '_sort_order' => 'ASC',
    );

    public function setPositionService(\Pix\SortableBehaviorBundle\Services\PositionHandler $positionHandler)
    {
        $this->positionService = $positionHandler;
    }
	
	public function createQuery($context = 'list')
    {
        $proxyQuery = parent::createQuery('list');
        // Default Alias is "o"
        // You can use `id` to hide root element
        // $proxyQuery->where('o.id != 1');
        $proxyQuery->addOrderBy('o.root', 'ASC');
        $proxyQuery->addOrderBy('o.lft', 'ASC');

        return $proxyQuery;
    }
	
	protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('up', $this->getRouterIdParameter().'/up/{position}');
        $collection->add('down', $this->getRouterIdParameter().'/down/{position}');
		$collection->add('move', $this->getRouterIdParameter().'/move/{position}');
    }
	
    protected function configureFormFields(FormMapper $formMapper)
    {
		// create custom query to hide the current element by `id`
        $subjectId = $this->getRoot()->getSubject()->getId();
        $query = null;

        if ($subjectId)
        {
            $query = $this->modelManager
                ->getEntityManager('Od\MainBundle\Entity\Category')
                ->createQueryBuilder('c')
                ->select('c')
                ->from('OdMainBundle:Category', 'c')
                ->where('c.id != '. $subjectId);
        }
		$formMapper->add('parent', 'sonata_type_model', array(
            'query' => $query,
            'required' => false, // remove this row after the root element is created
            'btn_add' => false,
            'property' => 'name',
			'empty_value' => '-- Select parent --'
        ));
        $formMapper->add('name', 'text');
		$formMapper->add('description', 'text');
		$formMapper->add('status', 'sonata_type_choice_field_mask', array(
                'choices' => array(
                    '1' => 'actif',
                    '0' => 'inactif',
                )
				));
		/*$formMapper->add('photo', 'sonata_type_model', array(
            'class' => 'Od\MainBundle\Entity\Image',
            'property' => 'title',
			'required' => false,
			'empty_value' => '-- Select Photo --'
        ));
		*/
        $formMapper->add('photo', 'sonata_type_model_list', array(
                    'btn_add'       => 'Add Photo',      //Specify a custom label
                    'btn_list'      => 'photo.list',     //which will be translated
                    'btn_delete'    => false,             //or hide the button.
                    'btn_catalogue' => 'SonataNewsBundle' //Custom translation domain for buttons
                ), array(
                    'placeholder' => 'No Photo selected'
                )				
				);		
		
		$formMapper->add('position');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper->add('id');
		$datagridMapper->add('name');
		$datagridMapper->add('status');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper->addIdentifier('ID');
		$listMapper->addIdentifier('name');
		$listMapper->add('description');
		$listMapper->add('status');
		$listMapper->add('_action', 'actions', array(
                'actions' => array(
                    'edit' => array(),
                    'delete' => array(),
                    'move' => array('template' => 'PixSortableBehaviorBundle:Default:_sort.html.twig'),
                ),
                'label' => 'Actions',
            ));
		$listMapper->add('position');
		   
    
    }
	

    public function categoryPersist($object)
    {
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository("OdMainBundle:Category");
        $repo->verify();
        $repo->recover();
		$em->persist($object);
        $em->flush();
        
    }

    public function categoryUpdate($object)
    {
        $em = $this->modelManager->getEntityManager($object);
        $repo = $em->getRepository("OdMainBundle:Category");
        $repo->verify();
        $repo->recover();
		$em->persist($object);
        $em->flush();
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


















































?>