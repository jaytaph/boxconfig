<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use BoxConfig\BoxBundle\Entity\Configuration;
use BoxConfig\BoxBundle\Form\ConfigurationType;

/**
 * Configuration controller.
 *
 */
class ConfigurationController extends Controller
{
    /**
     * Lists all Configuration entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('BoxConfigBoxBundle:Configuration')->findAll();

        return $this->render('BoxConfigBoxBundle:Configuration:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Configuration entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Configuration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Configuration entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:Configuration:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Configuration entity.
     *
     */
    public function newAction()
    {
        $entity = new Configuration();
        $form   = $this->createForm(new ConfigurationType(), $entity);

        return $this->render('BoxConfigBoxBundle:Configuration:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Configuration entity.
     *
     */
    public function createAction()
    {
        $entity  = new Configuration();
        $request = $this->getRequest();
        $form    = $this->createForm(new ConfigurationType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            //return new Response("<script>parent.jQuery.fancybox.close();</script>");
            return $this->redirect($this->generateUrl('configuration_show', array('id' => $entity->getId())));
        }

        return $this->render('BoxConfigBoxBundle:Configuration:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Configuration entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Configuration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Configuration entity.');
        }

        $editForm = $this->createForm(new ConfigurationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('BoxConfigBoxBundle:Configuration:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Configuration entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Configuration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Configuration entity.');
        }

        $editForm   = $this->createForm(new ConfigurationType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('configuration_edit', array('id' => $id)));
        }

        return $this->render('BoxConfigBoxBundle:Configuration:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Configuration entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('BoxConfigBoxBundle:Configuration')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Configuration entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('configuration'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
