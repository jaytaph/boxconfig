<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\BoxBundle\Entity\OperatingSystem;
use BoxConfig\BoxBundle\Form\OperatingSystemType;

/**
 * OperatingSystem controller.
 *
 */
class OperatingSystemController extends Controller
{
    /**
     * Lists all OperatingSystem entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->findAll();

        return $this->render('BoxConfigBoxBundle:OperatingSystem:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a OperatingSystem entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperatingSystem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:OperatingSystem:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new OperatingSystem entity.
     *
     */
    public function newAction()
    {
        $entity = new OperatingSystem();
        $form   = $this->createForm(new OperatingSystemType(), $entity);

        return $this->render('BoxConfigBoxBundle:OperatingSystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new OperatingSystem entity.
     *
     */
    public function createAction()
    {
        $entity  = new OperatingSystem();
        $request = $this->getRequest();
        $form    = $this->createForm(new OperatingSystemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('operatingsystem_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BoxConfigBoxBundle:OperatingSystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing OperatingSystem entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperatingSystem entity.');
        }

        $editForm = $this->createForm(new OperatingSystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:OperatingSystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing OperatingSystem entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperatingSystem entity.');
        }

        $editForm   = $this->createForm(new OperatingSystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('operatingsystem_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigBoxBundle:OperatingSystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a OperatingSystem entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OperatingSystem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('operatingsystem'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
