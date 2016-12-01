<?php

namespace Od\MainBundle\Controller;



use Od\MainBundle\Entity\Contact;
use Od\MainBundle\Form\ContactType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
	public function indexAction()
    {
	
	/*
	* A-la-une
	*/
		$em = $this->getDoctrine()
                   ->getEntityManager();
	    $SliderPosts = $em->getRepository('OdMainBundle:Post')
                          ->getPosts(3,3); 		
	/*
	* Intro
	*/	
     	$IntroPosts = $em->getRepository('OdMainBundle:Post')
                    ->getPosts(2, 1); 
					
					
	/*
	* Abous us
	*/					
     	$aboutus = $em->getRepository('OdMainBundle:Post')
                    ->getPosts(5, 1); 	
					
	/*
	* services
	*/					
     	$services = $em->getRepository('OdMainBundle:Post')
                    ->getPosts(6, 4); 	

	/*
	* Latest Work
	*/					
     	$latest_work = $em->getRepository('OdMainBundle:Album')
                    ->getAlbums(8); 					
					
	    return $this->render('OdMainBundle:Home:index.html.twig', 
		       array('SliderPosts' => $SliderPosts, 'IntroPosts' => $IntroPosts, 'aboutus' => $aboutus, 'services' => $services, 'latest_work' => $latest_work

        ));
    }
	
	
	public function contactAction(Request $request)
    {
        //return $this->render('OdMainBundle:Home:contact.html.twig');
		$contact = new Contact();
		//$form = $this->createForm(new ContactType(), $contact);
		$form = $this->createForm(ContactType::class, $contact);

		//$request = $this->getRequest();
		$form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
			
			
			 
			//$form->bind($request);

			//if ($form->isValid()) {
			   $message = \Swift_Message::newInstance()
				->setSubject('Message de contact de la part OpenDev')
				->setFrom($form->get('email')->getData())
				->setTo($this->container->getParameter('Od_Main.emails.contact_email'))
				->setBody($this->renderView('OdMainBundle:Home:contactEmail.txt.twig', array('contact' => $contact)));
			$this->get('mailer')->send($message);

			//$this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
			//$request->getSession()->getFlashBag()->add('success', 'Your email has been sent! Thanks!');
            $em = $this->getDoctrine()->getManager();
			$em->persist($contact);
            $em->flush();
			
			// Redirect - This is important to prevent users re-posting
			// the form if they refresh the page
			return $this->redirect($this->generateUrl('od_main_contact'));
			//}
		}

		return $this->render('OdMainBundle:Home:contact.html.twig', array(
			'form' => $form->createView()
		));
	
	
	
    }
	
	public function stylesAction()
    {
        return $this->render('OdMainBundle:Home:styles.html.twig');
    }
	
	public function typographyAction()
    {
        return $this->render('OdMainBundle:Home:typography.html.twig');
    }
	
}
