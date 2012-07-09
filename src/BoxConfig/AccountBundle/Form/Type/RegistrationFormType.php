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
        $builder->add('username', null, array(
                                              'label' => 'Username',
                                              'widget_suffix' => "<span id='usercheck'>&nbsp;</span>"));
        $builder->add('email', null, array(
                                           'label' => 'Email address',
                                           'widget_suffix' => "<span id='emailcheck'>&nbsp;</span> <span id='gravatar'>&nbsp;</span>"));
        $builder->add('plainPassword', 'repeated', array(
                                                        'type' => 'password',
                                                        'widget_suffix' => "<span id='samepassword'>&nbsp;</span>",
                                                        'first_name' => 'Password',
                                                        'second_name' => 'Verification'));
        $builder->add('fullname', null, array('label' => "Full name"));
        $builder->add('twitterHandle', null, array(
                                                   'widget_addon' => array('type' => 'prepend', 'text' => '@'),
                                                   'label' => 'your twitter handle',
                                                   'required' => false));
    }

    public function getName()
    {
        return 'boxconfig_user_registration';
    }
}
