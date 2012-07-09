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

            return $this->redirect($this->generateUrl('box_environment', array('machine_id' => $machine->getId())));
            
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

            return $this->redirect($this->generateUrl('box_environment', array('machine_id' => $machine->getId())));
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

        return $this->redirect($this->generateUrl('box_environment'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

}
