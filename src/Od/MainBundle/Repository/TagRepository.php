<?php

namespace Od\MainBundle\Repository;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Doctrine\ORM\EntityRepository;
/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TagRepository extends \Doctrine\ORM\EntityRepository
{
	
			
	public function getTags($limit= null)
    {
            
		  $qb = $this->createQueryBuilder('t')
				  ->Where('t.status=1')
				  ->setMaxResults($limit);

		   $tags = $qb->getQuery()
					->getResult();	

        return $tags;
    }
	
    
}
