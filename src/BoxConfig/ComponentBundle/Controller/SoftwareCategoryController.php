<?php

namespace BoxConfig\ComponentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\ComponentBundle\Entity\SoftwareCategory;
use BoxConfig\ComponentBundle\Form\SoftwareCategoryType;

/**
 * SoftwareCategory controller.
 *
 */
class SoftwareCategoryController extends Controller
{
    /**
     * Lists all SoftwareCategory entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigComponentBundle:SoftwareCategory')->findAll();

        return $this->render('BoxConfigComponentBundle:SoftwareCategory:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a SoftwareCategory entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:SoftwareCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SoftwareCategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigComponentBundle:SoftwareCategory:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new SoftwareCategory entity.
     *
     */
    public function newAction()
    {
        $entity = new SoftwareCategory();
        $form   = $this->createForm(new SoftwareCategoryType($entity), $entity);

        return $this->render('BoxConfigComponentBundle:SoftwareCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new SoftwareCategory entity.
     *
     */
    public function createAction()
    {
        $entity  = new SoftwareCategory();
        $request = $this->getRequest();
        $form    = $this->createForm(new SoftwareCategoryType($entity), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('softwarecategory_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BoxConfigComponentBundle:SoftwareCategory:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing SoftwareCategory entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:SoftwareCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SoftwareCategory entity.');
        }

        $editForm = $this->createForm(new SoftwareCategoryType($entity), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigComponentBundle:SoftwareCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing SoftwareCategory entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:SoftwareCategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SoftwareCategory entity.');
        }

        $editForm   = $this->createForm(new SoftwareCategoryType($entity), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('softwarecategory_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigComponentBundle:SoftwareCategory:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a SoftwareCategory entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigComponentBundle:SoftwareCategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SoftwareCategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('softwarecategory'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
