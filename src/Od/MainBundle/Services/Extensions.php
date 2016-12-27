<?php

namespace Od\MainBundle\Services;

use Symfony\Bridge\Doctrine\RegistryInterface;
 
class Extensions extends \Twig_Extension
{ 


	protected $doctrine;

    public function __construct(RegistryInterface $doctrine)
        {
            $this->doctrine = $doctrine;
     }
		
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('count_post', array($this, 'countPostByTag')),
			new \Twig_SimpleFilter('show_date', array($this, 'format_date')),
        );
    }

    public function countPostByTag($tag_id)
    {
		
        $em = $this->doctrine->getEntityManager();

		$count = $em->getRepository('OdMainBundle:Post')->findPostBytag($tag_id);
		
		return $count;
		
		
		
    }
    
	public function format_date($date, $filtre){
		
		$tab_date = explode("-",$date);
		$annee = $tab_date[0];
		$mois = $tab_date[1];
		$jour = $tab_date[2];
		
		switch($filtre){
			
			case 0 : return $annee; break;
			case 1 : return $mois; break;
			case 2 : return $jour; break;
		}
	}
    public function getName()
    {
        return 'app_extension';
    }
}