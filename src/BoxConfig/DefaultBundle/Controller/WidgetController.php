<?php

namespace BoxConfig\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class WidgetController extends Controller
{
    public function topAction($slug)
    {
        $em = $this->getDoctrine()->getEntityManager();

        switch ($slug) {
            case "hardware" :
                $title = "Hardware";
                $items = $em->getRepository('BoxConfigBoxBundle:Hardware')->getTop(5);
                break;
            case "ide" :
                $title = "PHP IDE's";
                // @TODO: This needs to be created.
                $items = $em->getRepository('BoxConfigBoxBundle:Software')->getTop(4, 5);
                break;
            case "os" :
                $title = "Operating Systems";
                $items = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->getTop(5);
                break;
            default :
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                break;
        }


        // Sort on percentages
        uasort($items, function($a, $b) {
            return ($a->scalarPercentage < $b->scalarPercentage);
        });

        return $this->render("BoxConfigDefaultBundle:Widget:top.html.twig", array("title" => $title, "items" => $items));
    }

    public function registerAction()
    {
        return $this->render('BoxConfigDefaultBundle:Widget:register.html.twig');
    }

    public function tipAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        switch (rand(1,7)) {
            case 1:
                $tip = "Did you know you can easily add friends and view their environments?";
                break;
            case 2:
                $tip = "Did you know that <b>PHPStorm</b> is the favourite PHP Editor?";
                break;
            case 3:
                $items = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->getTop(1, true);
                $tip = "Did you know that <b>".(string)$items[0]."</b> is most virtualized operating system?";
                break;
            case 4:
                $items = $em->getRepository('BoxConfigBoxBundle:OperatingSystem')->getTop(1);
                $tip = "Did you know that <b>".(string)$items[0]."</b> is most used operating system?";
                break;
            case 5:
                $users = $em->getRepository('BoxConfigAccountBundle:User')->getCount();
                $machines = $em->getRepository('BoxConfigBoxBundle:Machine')->getCount();

                $tip = "Our users have on average <b>".round($users / $machines, 2)."</b> machines registered.";
                break;
            case 6:
                $users = $em->getRepository('BoxConfigAccountBundle:User')->getCount();
                $envs = $em->getRepository('BoxConfigBoxBundle:Environment')->getCount();

                $tip = "Our users have on average <b>".round($users / $envs, 2)."</b> environments registered.";
                break;
            default:
                $users = $em->getRepository('BoxConfigAccountBundle:User')->getCount();
                $machines = $em->getRepository('BoxConfigBoxBundle:Machine')->getCount();

                $tip = "Did you know that there are currently <b>".$users."</b> registered users with a total of <b>".$machines."</b> boxes?";
                break;
        }
        return $this->render('BoxConfigDefaultBundle:Widget:tip.html.twig', array('tip' => $tip));
    }

    public function controlpanelAction()
    {
        return $this->render('BoxConfigDefaultBundle:Widget:controlpanel.html.twig');
    }

    public function matchmachineAction()
    {
        // @TODO: fetch current user. find matches, return these
        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->getRepository('BoxConfigAccountBundle:User')->findOneByUsername("demo");

        $matches = array();
        $matches[] = array('user' => $user, 'percentage' => rand(100,10000) / 100);
        $matches[] = array('user' => $user, 'percentage' => rand(100,10000) / 100);
        $matches[] = array('user' => $user, 'percentage' => rand(100,10000) / 100);
        $matches[] = array('user' => $user, 'percentage' => rand(100,10000) / 100);
        $matches[] = array('user' => $user, 'percentage' => rand(100,10000) / 100);
        return $this->render('BoxConfigDefaultBundle:Widget:matchmachine.html.twig', array('matches' => $matches));
    }
}
