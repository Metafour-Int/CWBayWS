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
    /**
     * @Route("/category/view/{id}", name="categoryView")
     * @Method({"POST"})
     */
    public function viewCategoryAction($id)
    {
    	$data = array();
    	
    	if ($id == 0)
    	{
    		$data['id'] = 0;
    		$data['name'] = 'root';
    		$data['children'] = array();
    		foreach ($this->getRootCategories() as $c)
    		{
    			$data['children'][] =  array('id' => $c->getId(), 'name' => $c->getName());
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
    		$data['children'] = array();
    		foreach ($category->getChildren() as $c)
    		{
    			$data['children'][] =  array('id' => $c->getId(), 'name' => $c->getName());
    		}
    	}
    	return new Response(json_encode($data));
    }
    
    public function getRootCategories()
    {
    	$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery('SELECT c FROM AppBundle:Category c WHERE c.parent is null');
    	
    	return	$query->getResult();
    	 
    }
}
