<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;
use AppBundle\Entity\Category;

class CategoryController extends Controller
{
	const DATE_FORMAT = 'Y-m-d';
	
    /**
     * @Route("/category/view/{id}", defaults={"id" = 0}, name="categoryView")
     * @Method({"POST"})
     */
    public function viewCategoryAction($id)
    {
    	$data = array('children' => array(), 'ads' => array());
    	
    	if ($id == 0)
    	{
    		$data['id'] = 0;
    		$data['name'] = 'root';
    		
    		foreach ($this->getRootCategories() as $c)
    		{
    			$data['children'][] =  array('id' => $c->getId(), 'name' => $c->getName(), 'hasChildren' => !$c->getChildren()->isEmpty());
    		}
    		
    	}
    	else
    	{
    		$category = $this->getDoctrine()->getRepository('AppBundle:Category')->find($id);
    		
    		if (!$category)
    		{
    			throw $this->createNotFoundException("Category with id $id not found");
    		}
    		$data['id'] = $category->getId();
    		$data['name'] = $category->getName();
    		foreach ($category->getChildren() as $c)
    		{
    			$data['children'][] =  array('id' => $c->getId(), 'name' => $c->getName(), 'hasChildren' => !$c->getChildren()->isEmpty());
    		}
    		
    		$ads = $this->getOpenAds($category);
    		if ($ads)
    		{
    			foreach ($ads as $ad)
    			{
    				$data['ads'][] = array(
    						'id' => $ad->getId(),
    						'title' => $ad->getTitle(),
    						'price' => (float)$ad->getPrice(),
    						'postedFrom' => $ad->getPostedFrom()->getName() . ', ' . $ad->getPostedFrom()->getCity()->getName(),
    						'postedAt' => $ad->getPostedAt()->format(self::DATE_FORMAT)
    				);
    			}
    		}
    	}
    	return new Response(json_encode($data));
    }
    
    private function getRootCategories()
    {
    	$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery('SELECT c FROM AppBundle:Category c WHERE c.parent is null');
    	
    	return	$query->getResult();
    	 
    }
    
    
    private function getOpenAds($category)
    {
    	$em = $this->getDoctrine()->getManager();
    	$query = $em->createQuery('SELECT a FROM AppBundle:Ad a WHERE a.category = :cat and a.approved=true and a.closed=false')
    	->setParameter('cat', $category);
    	
    	return $query->getResult();
    }
    
}
