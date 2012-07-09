<?php

namespace BoxConfig\ComponentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\ComponentBundle\Entity\Hardware;
use BoxConfig\ComponentBundle\Form\HardwareType;

/**
 * Hardware controller.
 *
 */
class HardwareController extends Controller
{
    /**
     * Lists all Hardware entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigComponentBundle:Hardware')->findAll();

        return $this->render('BoxConfigComponentBundle:Hardware:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Hardware entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:Hardware')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigComponentBundle:Hardware:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Hardware entity.
     *
     */
    public function newAction()
    {
        $entity = new Hardware();
        $form   = $this->createForm(new HardwareType(), $entity);

        return $this->render('BoxConfigComponentBundle:Hardware:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Hardware entity.
     *
     */
    public function createAction()
    {
        $entity  = new Hardware();
        $request = $this->getRequest();
        $form    = $this->createForm(new HardwareType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('component_hardware_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BoxConfigComponentBundle:Hardware:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Hardware entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:Hardware')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $editForm = $this->createForm(new HardwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigComponentBundle:Hardware:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Hardware entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:Hardware')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $editForm   = $this->createForm(new HardwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('component_hardware_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigComponentBundle:Hardware:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Hardware entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigComponentBundle:Hardware')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Hardware entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('component_hardware'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
