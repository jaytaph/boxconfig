<?php

namespace BoxConfig\AccountBundle\Form\Type;

use Symfony\Component\Form\FormBuilder;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class RegistrationFormType extends BaseType
{

    public function buildForm(FormBuilder $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('username', null, array('label' => 'Your username', 'widget_suffix' => "<span id='usercheck'>&nbsp;</span>"));
        $builder->add('email', null, array('label' => 'Your email address', 'widget_suffix' => "<span id='emailcheck'>&nbsp;</span> <span id='gravatar'>&nbsp;</span>"));
        $builder->add('fullname', null, array('label' => "Your full name"));
        $builder->add('twitterHandle', null, array('widget_addon' => array('type' => 'prepend', 'text' => '@'), 'label' => 'your twitter handle', 'required' => false));
        $builder->add('plainPassword', 'repeated', array('type' => 'password', 'widget_suffix' => "<span id='samepassword'>CHECKCHECK</span>"));
    }

    public function getName()
    {
        return 'boxconfig_user_registration';
    }
}
