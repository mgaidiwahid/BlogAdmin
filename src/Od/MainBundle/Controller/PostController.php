<?php

namespace Od\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PostController extends Controller
{
	public function showAction($id,$slug)
    {
		$em = $this->getDoctrine()->getEntityManager();

			$blog = $em->getRepository('OdMainBundle:Post')->find($id);
            //dump($blog);die();
			$categ = $blog->getCategories();
			//dump($categ);die();
			if (!$blog) {
				throw $this->createNotFoundException('Unable to find Blog post.');
			}
			
		/*
	    * Recent Posts
	    */					
     	$recent_posts = $em->getRepository('OdMainBundle:Post')
                    ->getRecentPosts(5);
		
		/*
		* Tags list
		*/					
     	$tags = $em->getRepository('OdMainBundle:Tag')
                    ->getTags(15);
					
        return $this->render('OdMainBundle:Post:post.html.twig', array(
            'blog'      => $blog,
			'categ'      => $categ,
			'recent_posts' => $recent_posts,
			'tags' => $tags
			
        ));
	}
}
