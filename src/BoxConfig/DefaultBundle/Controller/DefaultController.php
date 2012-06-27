<?php

namespace BoxConfig\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BoxConfig\DefaultBundle\Entity\Enquiry;
use BoxConfig\DefaultBundle\Form\EnquiryType;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        $template = 'BoxConfigDefaultBundle:Default:index/anonymous.html.twig';
        $args = array();

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY') ) {
            $user = $this->get('security.context')->getToken()->getUser();

            /**
             * @var $user \BoxConfig\AccountBundle\Entity\User
             */

            if (count($user->getMachines()) == 0) {
                $template = 'BoxConfigDefaultBundle:Default:index/no_machines.html.twig';
//            } elseif ($user->getSoftware() == 0) {
//                $template = 'BoxConfigDefaultBundle:Default:index/no_software.html.twig';
            // @TODO: check friends
            // } elseif ($user->getFriends() == 0) {
            } else {
                $template = 'BoxConfigDefaultBundle:Default:index/loggedin.html.twig';
            }
        }

        return $this->render($template, $args);
    }

    public function aboutAction()
    {
        return $this->render('BoxConfigDefaultBundle:Default:about.html.twig');
    }

    public function contactAction()
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $enquiry);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                            ->setSubject('Contact enquiry from box-config.com')
                            ->setFrom(array(
                                $this->container->getParameter('emails.contact_email') =>
                                $this->container->getParameter('emails.contact_name')))
                            ->setTo(array(
                                $this->container->getParameter('emails.contact_email') =>
                                $this->container->getParameter('emails.contact_name')))
                            ->setBody($this->renderView('BoxConfigDefaultBundle:Default:contactEmail.txt.twig', array('enquiry' => $enquiry)));
                $this->get('mailer')->send($message);

                $this->get('session')->setFlash('notice', 'Your contact enquiry was successfully sent. Thank you!');

                return $this->redirect($this->generateUrl('BoxConfigDefaultBundle_contact'));
            }
        }

        return $this->render('BoxConfigDefaultBundle:Default:contact.html.twig', array('form' => $form->createView()));
    }

}
