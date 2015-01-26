<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Category;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return new Response('OK');
    }
    
    /**
     * @Route("/test", name="test")
     */
    public function testAction()
    {
    	$em = $this->getDoctrine()->getManager();
    	$parent = $this->getDoctrine()->getRepository('AppBundle:Category')->find(13);
    	
    	
    	
    	
    	return new Response($parent->getChildren()->count());
    }
}
