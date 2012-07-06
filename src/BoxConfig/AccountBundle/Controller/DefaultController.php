<?php

namespace BoxConfig\AccountBundle\Controller;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use BoxConfig\AccountBundle\Entity\User;

class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('BoxConfigAccountBundle:Default:index.html.twig', array('name' => $name));
    }

    public function checkuserAction()
    {
        $username = $this->getRequest()->get('username');

        if (empty($username)) {
            throw new AccessDeniedHttpException();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository("BoxConfigAccountBundle:User")->findOneByUsernameCanonical(strtolower($username));

        $response = new Response();
        $response->setStatusCode(200);
        $response->setContent(json_encode(array("status" => $user == null ? "free" : "taken")));
        return $response;
    }

    public function checkemailAction()
    {
        $email = $this->getRequest()->get('email');

        if (empty($email)) {
            throw new AccessDeniedHttpException();
        }

        $em = $this->getDoctrine()->getEntityManager();
        $email = $em->getRepository("BoxConfigAccountBundle:User")->findOneByEmailCanonical(strtolower($email));

        $response = new Response();
        $response->setStatusCode(200);
        $response->setContent(json_encode(array("status" => $email == null ? "free" : "taken")));
        return $response;
    }

}
