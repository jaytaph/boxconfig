<?php

namespace BoxConfig\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BoxConfig\DefaultBundle\Entity\Enquiry;
use BoxConfig\DefaultBundle\Form\EnquiryType;


class DefaultController extends Controller
{
    
    public function indexAction()
    {
        return $this->render('BoxConfigDefaultBundle:Default:index.html.twig');
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
                            ->setSubject('Contact enquiry from symblog')
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
