<?php

namespace BoxConfig\DefaultBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class SidebarController extends Controller
{
    public function topAction($slug)
    {
        switch ($slug) {
            case "ide" :
                $title = "IDE's";
                $items = array(
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'PHPStorm'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'Eclipse'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'Netbeans'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'Vim'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'Notepad++'),
                    );
                break;
            case "os" :
                $title = "Operating Systems";
                $items = array(
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'OSX Lion'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'Debian 6.0'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'Windows 7'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'OSX Snow Leopard'),
                    array("link" => '#', 'percentage' => rand(0, 100), 'title' => 'CentOS 6.2'),
                    );
                break;
            default :
                throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
                break;
        }
        return $this->render('BoxConfigDefaultBundle:Sidebar:top.html.twig', array("title" => $title, "items" => $items));
    }

    public function registerAction()
    {
        return $this->render('BoxConfigDefaultBundle:Sidebar:register.html.twig');
    }

    public function tipAction()
    {
        $users = range(1, rand(100,1000));
        $boxes = range(1, rand(100,1000));
        $tip = "Did you know that there are currently <b>".count($users)."</b> registered with a total of <b>".count($boxes)."</b> boxes?";
        return $this->render('BoxConfigDefaultBundle:Sidebar:tip.html.twig', array('tip' => $tip));
    }

}
