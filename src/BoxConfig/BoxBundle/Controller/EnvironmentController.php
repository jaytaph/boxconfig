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
 * Environment controller.
 *
 */
class EnvironmentController extends Controller
{

    protected function getMachine($machine_id) {
        $em = $this->getDoctrine()->getEntityManager();
        $machine = $em->getRepository('BoxConfigBoxBundle:Machine')->findOneById($machine_id);
        if (! $machine) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
        }
        return $machine;
    }

    /**
     * Lists all environment entities.
     *
     */
    public function indexAction($machine_id)
    {
        $machine = $this->getMachine($machine_id);

        $em = $this->getDoctrine()->getEntityManager();


        return $this->render('BoxConfigBoxBundle:Environment:index.html.twig', array(
            'machine' => $machine,
        ));
    }

    /**
     * Displays a form to create a new Environment entity.
     */
    public function newAction($machine_id)
    {
        $machine = $this->getMachine($machine_id);

        $entity = new Environment();
        $form   = $this->createForm(new EnvironmentType(), $entity);
        if (count($machine->getEnvironments()) == 0) {
            $form->remove('virtualized');
        }

        return $this->render('BoxConfigBoxBundle:Environment:new.html.twig', array(
            'machine' => $machine,
            'entity'  => $entity,
            'form'    => $form->createView()
        ));
    }

    /**
     * Creates a new Environment entity.
     *
     * @ParamConverter("machine", class="BoxConfigBoxBundle:Machine")
     *
     */
    public function createAction($machine_id)
    {
        $machine = $this->getMachine($machine_id);

        $entity  = new Environment();
        $request = $this->getRequest();
        $form    = $this->createForm(new EnvironmentType(), $entity);

        $form->bindRequest($request);

        if ($form->isValid()) {

            // Connect this environment to the correct machine
            $entity->setMachine($machine);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('environment', array('machine_id' => $machine->getId())));
            
        }

        return $this->render('BoxConfigBoxBundle:Environment:new.html.twig', array(
            'machine' => $machine,
            'entity'  => $entity,
            'form'    => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Environment entity.
     *
     * @ParamConverter("machine", class="BoxConfigBoxBundle:Machine")
     *
     *
     */
    public function editAction($machine_id, $id)
    {
        $machine = $this->getMachine($machine_id);

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('BoxConfigBoxBundle:Environment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find environment entity.');
        }

        $editForm = $this->createForm(new EnvironmentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:Environment:edit.html.twig', array(
            'machine'     => $machine,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Environment entity.
     *
     * @ParamConverter("machine", class="BoxConfigBoxBundle:Machine")
     *
     */
    public function updateAction($machine_id, $id)
    {
        $machine = $this->getMachine($machine_id);

        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('BoxConfigBoxBundle:Environment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find environment entity.');
        }

        $editForm   = $this->createForm(new EnvironmentType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('environment', array('machine_id' => $machine->getId())));
        }

        return $this->render('BoxConfigBoxBundle:Environment:edit.html.twig', array(
            'machine'     => $machine,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Environment entity.
     *
     * @ParamConverter("machine", class="BoxConfigBoxBundle:Machine")
     *
     */
    public function deleteAction($machine_id, $id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigBoxBundle:Environment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find environment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Environment'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }


    /**
     * Displays a form to edit an existing Environment entity.
     *
     * @ParamConverter("machine", class="BoxConfigBoxBundle:Machine")
     *
     *
     */
    public function softwareAction($machine_id, $id)
    {
        $machine = $this->getMachine($machine_id);

        $em = $this->getDoctrine()->getEntityManager();
        $environment = $em->getRepository('BoxConfigBoxBundle:Environment')->find($id);

        if (!$environment) {
            throw $this->createNotFoundException('Unable to find environment entity.');
        }

        // @TODO: Only fetch software for this particular OS?
        $software = $em->getRepository('BoxConfigComponentBundle:Software')->findAll();

        return $this->render('BoxConfigBoxBundle:Environment:software.html.twig', array(
            'machine'     => $machine,
            'environment' => $environment,
            'software'    => $software,
        ));
    }


    public function ajaxAction($machine_id, $environment_id, $command, $software_id)
    {
        $ret = array("status" => "ok");

        if (! $this->getRequest()->isXmlHttpRequest()) {
            throw new AccessDeniedHttpException();
        }

        $machine = $this->getMachine($machine_id);

        $em = $this->getDoctrine()->getEntityManager();

        $environment = $em->getRepository('BoxConfigBoxBundle:Environment')->find($environment_id);
        if (!$environment) {
            throw $this->createNotFoundException('Unable to find environment entity.');
        }

        if ($command != "add" && $command != "remove" && $command != "toggle") {
            throw $this->createNotFoundException('Unable to find command.');
        }

        $software = $em->getRepository('BoxConfigComponentBundle:Software')->find($software_id);
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
