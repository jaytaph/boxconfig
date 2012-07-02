<?php

namespace BoxConfig\BoxBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

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

        // Only fetch items from the current user
        $user = $this->get("security.context")->getToken()->getUser();
        $entities = $em->getRepository('BoxConfigBoxBundle:Machine')->findByUser($user->getId());

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

        $user = $this->get("security.context")->getToken()->getUser();
        $entity->setUser($user);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            $this->assignAcl($entity);

            if (count($user->getMachines()) == 1) {
                $this->get('session')->setFlash('success',"Your first machine has been created!");
            } else {
                $this->get('session')->setFlash('success',"A new machine has been created!");
            }
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

        $securityContext = $this->get('security.context');
        if ($securityContext->isGranted('EDIT', $entity) == false)
        {
            throw new AccessDeniedException();
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

            $this->get('session')->setFlash('success',"Your machine has been updated!");
            return $this->redirect($this->generateUrl('machine'));
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
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('BoxConfigBoxBundle:Machine')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Machine entity.');
        }

        $securityContext = $this->get('security.context');
        if ($securityContext->isGranted('DELETE', $entity) == false)
        {
            throw new AccessDeniedException();
        }

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

    private function assignAcl($entity) {
        // create the ACL
        $aclProvider = $this->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($entity);
        $acl = $aclProvider->createAcl($objectIdentity);

        // retrieving the security identity of the currently logged-in user
        $securityContext = $this->get('security.context');
        $user = $securityContext->getToken()->getUser();
        $securityIdentity = UserSecurityIdentity::fromAccount($user);
        $roleSecurityIdentity = new RoleSecurityIdentity('ROLE_ADMIN');

        // grant owner access
        $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OPERATOR);
        $acl->insertObjectAce($roleSecurityIdentity, MaskBuilder::MASK_MASTER);
        $aclProvider->updateAcl($acl);
    }
}
