<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\BoxBundle\Entity\BaseOperatingSystem;
use BoxConfig\BoxBundle\Form\BaseOperatingSystemType;

/**
 * BaseOperatingSystem controller.
 *
 */
class BaseOperatingSystemController extends Controller
{
    /**
     * Lists all BaseOperatingSystem entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigBoxBundle:BaseOperatingSystem')->findAll();

        return $this->render('BoxConfigBoxBundle:BaseOperatingSystem:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a BaseOperatingSystem entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:BaseOperatingSystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseOperatingSystem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:BaseOperatingSystem:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new BaseOperatingSystem entity.
     *
     */
    public function newAction()
    {
        $entity = new BaseOperatingSystem();
        $form   = $this->createForm(new BaseOperatingSystemType(), $entity);

        return $this->render('BoxConfigBoxBundle:BaseOperatingSystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new BaseOperatingSystem entity.
     *
     */
    public function createAction()
    {
        $entity  = new BaseOperatingSystem();
        $request = $this->getRequest();
        $form    = $this->createForm(new BaseOperatingSystemType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('BaseOperatingSystem_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BoxConfigBoxBundle:BaseOperatingSystem:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing BaseOperatingSystem entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:BaseOperatingSystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseOperatingSystem entity.');
        }

        $editForm = $this->createForm(new BaseOperatingSystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:BaseOperatingSystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing BaseOperatingSystem entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:BaseOperatingSystem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find BaseOperatingSystem entity.');
        }

        $editForm   = $this->createForm(new BaseOperatingSystemType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('BaseOperatingSystem_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigBoxBundle:BaseOperatingSystem:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a BaseOperatingSystem entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigBoxBundle:BaseOperatingSystem')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find BaseOperatingSystem entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('BaseOperatingSystem'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
