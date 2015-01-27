<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Category;
use AppBundle\Entity\City;
use AppBundle\Entity\Place;
use AppBundle\Entity\Ad;
use Symfony\Component\Validator\Constraints\Date;

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
    	/* $em = $this->getDoctrine()->getManager();
    	$category = $this->getDoctrine()->getRepository('AppBundle:Category')->find(14);
    	
    	$place = $this->getDoctrine()->getRepository('AppBundle:Place')->find(5);
    	
    	$ad = new Ad();
    	$ad->setCategory($category);
    	$ad->setPostedFrom($place);
    	$ad->setTitle('HTC One V Android Phone');
    	$ad->setDescription("One year used phone.\nReason for sale: want to buy new phone.");
    	$ad->setPrice(7000);
    	$ad->setPostedAt(new \DateTime('now'));
    	$ad->setApproved(true);
    	$ad->setClosed(false);
    	$ad->setContactName('Nadim');
    	$ad->setContactNumber('01778952369');
    	$ad->setContactMail('nadim@meta4.com');
    	$em->persist($ad);
    	$em->flush(); */
    	
   	
    	return new Response();
    }
}
