<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use BoxConfig\BoxBundle\Entity\Machine;
use BoxConfig\BoxBundle\Form\MachineType;

/**
 * Machine controller.
 *
 */
class MachineController extends Controller
{
    /**
     * Lists all Machine entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigBoxBundle:Machine')->findAll();

        return $this->render('BoxConfigBoxBundle:Machine:index.html.twig', array(
            'entities' => $entities
        ));
    }


    /**
     * Displays a form to create a new Machine entity.
     *
     */
    public function newAction()
    {
        $entity = new Machine();
        $form   = $this->createForm(new MachineType(), $entity);

        return $this->render('BoxConfigBoxBundle:Machine:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Machine entity.
     *
     */
    public function createAction()
    {
        $entity  = new Machine();
        $request = $this->getRequest();
        $form    = $this->createForm(new MachineType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            //return new Response("<script>parent.jQuery.fancybox.close();</script>");
            return $this->redirect($this->generateUrl('machine'));
        }

        return $this->render('BoxConfigBoxBundle:Machine:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Machine entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Machine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Machine entity.');
        }

        $editForm = $this->createForm(new MachineType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:Machine:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Machine entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Machine')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find machine entity.');
        }

        $editForm   = $this->createForm(new MachineType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('Machine_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigBoxBundle:Machine:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Machine entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigBoxBundle:Machine')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Machine entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('machine'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
