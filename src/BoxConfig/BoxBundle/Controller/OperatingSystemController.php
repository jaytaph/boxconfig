<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\BoxBundle\Entity\Operatingsystem;
use BoxConfig\BoxBundle\Form\OperatingsystemType;

/**
 * Operatingsystem controller.
 *
 */
class OperatingsystemController extends Controller
{
    /**
     * Lists all Operatingsystem entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigBoxBundle:Operatingsystem')->findAll();

        return $this->render('BoxConfigBoxBundle:Operatingsystem:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Operatingsystem entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Operatingsystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Operatingsystem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:Operatingsystem:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Operatingsystem entity.
     *
     */
    public function newAction()
    {
        $entity = new Operatingsystem();
        $form   = $this->createForm(new OperatingsystemType(), $entity);

        return $this->render('BoxConfigBoxBundle:Operatingsystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Operatingsystem entity.
     *
     */
    public function createAction()
    {
        $entity  = new Operatingsystem();
        $request = $this->getRequest();
        $form    = $this->createForm(new OperatingsystemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Operatingsystem_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BoxConfigBoxBundle:Operatingsystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Operatingsystem entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Operatingsystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Operatingsystem entity.');
        }

        $editForm = $this->createForm(new OperatingsystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:Operatingsystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Operatingsystem entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Operatingsystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Operatingsystem entity.');
        }

        $editForm   = $this->createForm(new OperatingsystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Operatingsystem_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigBoxBundle:Operatingsystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Operatingsystem entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigBoxBundle:Operatingsystem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Operatingsystem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('Operatingsystem'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
