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

			if (!$blog) {
				throw $this->createNotFoundException('Unable to find Blog post.');
			}
        return $this->render('OdMainBundle:Post:show.html.twig', array(
            'blog'      => $blog
        ));
	}
}
