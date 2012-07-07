<?php

namespace BoxBundle\DefaultBundle\Menu;
namespace BoxConfig\DefaultBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav pull-right');

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Home', array('route' => 'BoxConfigDefaultBundle_homepage'));
        $menu->addChild('About', array('route' => 'BoxConfigDefaultBundle_about'));
        $menu->addChild('Contact', array('route' => 'BoxConfigDefaultBundle_contact'));

        if ($this->container->get('security.context')->isGranted('IS_AUTHENTICATED_FULLY')) {
            $user = $this->container->get('security.context')->getToken()->getUser();


            // @TODO: We should fetch this directly, but through a service tag?
            $ext = new \BoxConfig\BoxBundle\Twig\badgeExtension();
            $tmp = $ext->badgeMachine($user);
            $menu->addChild('Machines '.$tmp, array('route' => 'machine'))->setAttribute('divider_prepend', true);

            $tmp = $ext->badgeSoftware($user);
            $menu->addChild('Software '.$tmp, array('route' => 'software'))->setAttribute('divider_append', true);;

            //$menu->addChild('c')->setLabel($user->getFullname());

            $gravatar = $this->container->get('gravatar.api');
            $menu->addChild($user->getFullName()." <img src='".$gravatar->getUrl($user->getEmail(), 25)."'>")->setAttribute('raw', true);

//            <p class="navbar-text">{{ app.user.fullname }} <img src="{{ gravatar(app.user.email, 25) }}"></p>
//            <li><p class="navbar-text">{{ app.user.fullname }} <img src="{{ gravatar(app.user.email, 25) }}"></p></li>
//            $user = $this->container->get('security.context')->getToken()->getUser();
//            $menu->addChild('Profile', array('route' => 'fos_user_security_logout'));
            $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        } else {
            $menu->addChild('Login', array('route' => 'fos_user_security_login'));
        }

        return $menu;
    }
}

/*
  <ul class="nav pull-right">
     <li class="active"><a href="{{ path("BoxConfigDefaultBundle_homepage") }}">Home</a></li>
     <li><a href="{{ path("BoxConfigDefaultBundle_about") }}">About</a></li>
     <li><a href="{{ path("BoxConfigDefaultBundle_contact") }}">Contact</a></li>

{% if app.user %}
{# This will be shown when we have logged in #}
     <li class="divider-vertical"></li>
     <li><a href="{{ path("machine") }}">Machines {{ badge_machine(app.user) }}</a></li>
     <li><a href="{{ path("software") }}">Software {{ badge_software(app.user) }}</a></li>

     <li class="divider-vertical"></li>
     <li><p class="navbar-text">{{ app.user.fullname }} <img src="{{ gravatar(app.user.email, 25) }}"></p></li>
     <li><a href="{{ path("fos_user_security_logout") }}">Profile</a></li>
     <li><a href="{{ path("fos_user_security_logout") }}">Logout</a></li>
{% else %}
{# Anonymous / non-logged in menu bar #}
     <li><a href="{{ path("fos_user_security_login") }}">Login</a></li>
     <li><a href="{{ path("fos_user_registration_register") }}">Register</a></li>
{% endif %}
 </ul>
 */