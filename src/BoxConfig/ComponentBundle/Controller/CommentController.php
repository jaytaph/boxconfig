<?php

namespace BoxConfig\ComponentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BoxConfig\ComponentBundle\Entity\Hardware;
use BoxConfig\ComponentBundle\Form\HardwareType;
use BoxConfig\ComponentBundle\Form\CommentType;
use BoxConfig\ComponentBundle\Entity\HardwareComment;
use BoxConfig\ComponentBundle\Entity\SoftwareComment;
use BoxConfig\ComponentBundle\Entity\OperatingSystemComment;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{

    public function hardwareNewAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("BoxConfigComponentBundle:Hardware")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $form   = $this->createForm(new CommentType(), new HardwareComment());

        return $this->render('BoxConfigComponentBundle:Comment:new.html.twig', array(
            'create_path' => 'user_hardware_comment_create',
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function softwareNewAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("BoxConfigComponentBundle:Software")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $form   = $this->createForm(new CommentType(), new SoftwareComment());

        return $this->render('BoxConfigComponentBundle:Comment:new.html.twig', array(
            'create_path' => 'user_software_comment_create',
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function operatingSystemNewAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("BoxConfigComponentBundle:OperatingSystem")->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find entity.');
        }

        $form   = $this->createForm(new CommentType(), new OperatingSystemComment());

        return $this->render('BoxConfigComponentBundle:Comment:new.html.twig', array(
            'create_path' => 'user_operatingsystem_comment_create',
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    public function hardwareCreateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('BoxConfigComponentBundle:Hardware')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Hardware entity.');
        }

        $comment  = new HardwareComment();
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $user = $this->get("security.context")->getToken()->getUser();
            $comment->setHardware($entity);
            $comment->setUser($user);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('component_hardware_show', array('id' => $entity->getId(), 'standalone' => '1')));
        }

        return $this->render('BoxConfigComponentBundle:Comment:new.html.twig', array(
            'entity'  => $entity,
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    public function softwareCreateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('BoxConfigComponentBundle:Software')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Software entity.');
        }

        $comment  = new SoftwareComment();
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $user = $this->get("security.context")->getToken()->getUser();
            $comment->setSoftware($entity);
            $comment->setUser($user);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('component_software_show', array('id' => $entity->getId(), 'standalone' => '1')));
        }

        return $this->render('BoxConfigComponentBundle:Comment:new.html.twig', array(
            'entity'  => $entity,
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }

    public function operatingSystemCreateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('BoxConfigComponentBundle:OperatingSystem')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OperatingSystem entity.');
        }

        $comment  = new OperatingSystemComment();
        $request = $this->getRequest();
        $form    = $this->createForm(new CommentType(), $comment);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $user = $this->get("security.context")->getToken()->getUser();
            $comment->setOperatingSystem($entity);
            $comment->setUser($user);

            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($comment);
            $em->flush();

            return $this->redirect($this->generateUrl('component_operatingsystem_show', array('id' => $entity->getId(), 'standalone' => '1')));
        }

        return $this->render('BoxConfigComponentBundle:Comment:new.html.twig', array(
            'entity'  => $entity,
            'comment' => $comment,
            'form'    => $form->createView()
        ));
    }
}
