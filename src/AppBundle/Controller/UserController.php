<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\User;

class UserController extends Controller
{
	const DATE_FORMAT = 'Y-m-d';
	const STATUS_EXISTS = 409;
	
	private function userExists($email) 
	{
		$em = $this->getDoctrine()->getManager();
		$user = $em->getRepository('AppBundle:User')->find($email);
		return $user ? true : false;
	}
	
	private function userToJson($user) 
	{
		$data = array(
			'email' => $user->getEmail(),
			'name' => $user->getName(),
			'image' => $user->getImage(),
			'memberSince' => $user->getMemberSince()->format(self::DATE_FORMAT)
		);
		return json_encode($data);
	}
	
    /**
     * @Route("/user/create", name="userCreate")
     * @Method({"POST"})
     */
    public function createUserAction()
    {
    	$data = json_decode($this->getRequest()->getContent(), true);
    	
    	$email = $data['email'];
    	
    	if ($this->userExists($email)) 
    	{
    		$response = new Response();
    		$response->setContent("Another user with email $email exists");
    		$response->setStatusCode(self::STATUS_EXISTS);
    		return $response;
    	}
    	
    	$user = new User();
    	$user->setEmail($data['email']);
    	$user->setPassword($data['password']);
    	
    	if (isset($data['name'])) $user->setName($data['name']);
    	else $user->setName('');
    	
    	if (isset($data['image'])) $user->setImage($data['image']);
    	else $user->setImage('');
    	
    	$user->setMemberSince(new \DateTime("now"));
    	$user->setIsActive(true);
    	
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($user);
    	$em->flush();
    	
        return new Response($this->userToJson($user));
    }
    
    /**
     * @Route("/user/view/{email}", name="userView")
     * @Method({"POST"})
     */
    public function viewUserAction($email)
    {
    	$user = $this->getDoctrine()->getRepository('AppBundle:User')->find($email);
    	if (!$user)
    	{
    		throw $this->createNotFoundException("User with email $email does not exist");
    	}
    	
    	return new Response($this->userToJson($user));
    }
    
    /**
     * @Route("/user/edit/{email}", name="userEdit")
     * @Method({"POST"})
     */
    public function editUserAction($email)
    {
    	$data = json_decode($this->getRequest()->getContent(), true);
    	
    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository('AppBundle:User')->find($email);
    	if (!$user)
    	{
    		throw $this->createNotFoundException("User with email $email does not exist");
    	}
    	
    	if (isset($data['email'])) {
    		$e = $data['email'];
    		if (!empty($e) && $this->userExists($e)) 
    		{
    			$response = new Response();
    			$response->setContent("Another user with email $e exists");
    			$response->setStatusCode(self::STATUS_EXISTS);
    			return $response;
    		}
    	}
    	
    	if (isset($e) && !empty($e))
    	{
	    	$user->setEmail($e);
    	}
    	
    	if (isset($data['name']))
    	{
    		$name = $data['name'];
    		if (!empty($name)) $user->setName($name);
    	}
    	
    	if (isset($data['image']))
    	{
	    	$image = $data['image'];
	    	if (!empty($image)) $user->setImage($image);
    	}
    	
    	if (isset($data['password']))
    	{
	    	$password = $data['password'];
	    	if (!empty($password)) $user->setPassword($data['password']);
    	}
    	
    	$em->flush();
    	
    	$user = $em->getRepository('AppBundle:User')->find(isset($newEmail) ? $newEmail : $email);
    	
    	return new Response($this->userToJson($user));
    }
    
    /**
     * @Route("/user/login/{email}", name="userLogin")
     * @Method({"POST"})
     */
    public function loginUserAction($email)
    {
    	$em = $this->getDoctrine()->getManager();
    	$user = $em->getRepository('AppBundle:User')->find($email);
    	if (!$user)
    	{
    		throw $this->createNotFoundException("User with email $email does not exist");
    	}
    	
    	return new Response($this->userToJson($user));
    }
}
