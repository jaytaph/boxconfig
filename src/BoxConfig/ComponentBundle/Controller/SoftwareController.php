<?php

namespace BoxConfig\ComponentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\ComponentBundle\Entity\Software;
use BoxConfig\ComponentBundle\Form\SoftwareType;

/**
 * Software controller.
 *
 */
class SoftwareController extends Controller
{
    /**
     * Lists all Software entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigComponentBundle:Software')->findAll();

        return $this->render('BoxConfigComponentBundle:Software:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Software entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:Software')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigComponentBundle:Software:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Software entity.
     *
     */
    public function newAction()
    {
        $entity = new Software();
        $form   = $this->createForm(new SoftwareType(), $entity);

        return $this->render('BoxConfigComponentBundle:Software:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Software entity.
     *
     */
    public function createAction()
    {
        $entity  = new Software();
        $request = $this->getRequest();
        $form    = $this->createForm(new SoftwareType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('component_software_show', array('id' => $entity->getId())));
            
        }

        return $this->render('BoxConfigComponentBundle:Software:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Software entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:Software')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $editForm = $this->createForm(new SoftwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigComponentBundle:Software:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Software entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigComponentBundle:Software')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $editForm   = $this->createForm(new SoftwareType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('component_software_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigComponentBundle:Software:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Software entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigComponentBundle:Software')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Software entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('component_software'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
