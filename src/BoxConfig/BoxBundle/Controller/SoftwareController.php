<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use BoxConfig\BoxBundle\Entity\Environment;
use BoxConfig\BoxBundle\Form\EnvironmentType;
use BoxConfig\BoxBundle\Entity\Machine;

/**
 * Software controller.
 *
 */
class SoftwareController extends Controller
{

    protected function getMachine($machine_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $machine = $em->getRepository('BoxConfigBoxBundle:Machine')->findOneById($machine_id);
        if (! $machine) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        return $machine;
    }

    protected function getEnvironment($environment_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $environment = $em->getRepository('BoxConfigBoxBundle:Environment')->findOneById($environment_id);
        if (! $environment) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        return $environment;
    }


    /**
     * Displays a form to edit an existing Environment entity.
     *
     */
    public function indexAction($machine_id, $environment_id)
    {
        $machine = $this->getMachine($machine_id);
        $environment = $this->getEnvironment($environment_id);

        $em = $this->getDoctrine()->getEntityManager();

        // @TODO: Only fetch software for this particular OS?
        $software = $em->getRepository('BoxConfigComponentBundle:Software')->findAll();
        $software = new \Doctrine\Common\Collections\ArrayCollection($software);

        // Filter software into "Installed software", "Available software" and "All software"
        $available_software = $software->filter(
           function($item) use($environment) {
               return ! $environment->hasSoftware($item);
           }
        );
        $installed_software = $software->filter(
           function($item) use($environment) {
               return $environment->hasSoftware($item);
           }
        );

        $paginator = $this->get('knp_paginator');
        $software = $paginator->paginate($software, $this->get('request')->query->get('page', 1), 25);
        $available_software = $paginator->paginate($available_software, $this->get('request')->query->get('page', 1), 25);
        $installed_software = $paginator->paginate($installed_software, $this->get('request')->query->get('page', 1), 25);

        return $this->render('BoxConfigBoxBundle:Software:index.html.twig', array(
            'machine'     => $machine,
            'environment' => $environment,
            'software'    => $software,
            'installed'    => $installed_software,
            'available'    => $available_software,
        ));
    }


    public function ajaxAction($machine_id, $environment_id, $command, $id)
    {
        $ret = array("status" => "ok");

        if (! $this->getRequest()->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException();
        }

        $machine = $this->getMachine($machine_id);
        $environment = $this->getEnvironment($environment_id);

        if ($command != "add" && $command != "remove" && $command != "toggle") {
            throw $this->createNotFoundException('Unable to find command.');
        }

        $em = $this->getDoctrine()->getEntityManager();
        $software = $em->getRepository('BoxConfigComponentBundle:Software')->find($id);
        if (!$software) {
            throw $this->createNotFoundException('Unable to find software entity.');
        }

        if ($command == "toggle") {
            if ($environment->getSoftware()->contains($software)) {
                $environment->getSoftware()->removeElement($software);
                $ret = array("status" => "present");
            } else {
                $environment->getSoftware()->add($software);
                $ret = array("status" => "absent");
            }
        }
        if ($command == "add") {
            if ($environment->getSoftware()->contains($software)) {
                $ret = array("status" => "already present");
            } else {
                $environment->getSoftware()->add($software);
                $ret = array("status" => "not present");
            }
        }
        if ($command == "remove") {
            if (! $environment->getSoftware()->contains($software)) {
                $ret = array("status" => "not present");
            } else {
                $environment->getSoftware()->removeElement($software);
            }
        }

        $em->flush();

        $response = new Response();
        $response->setStatusCode(200);
        $response->setContent(json_encode($ret));
//        $response->headers->set('Content-Type', 'text/json');
        return $response;
    }
}
