<?php

namespace BoxConfig\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ConfigurationType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('operatingSystem')
            ->add('machine')
            ->add('virtualized', 'checkbox', array('required' => false))
        ;
    }

    public function getName()
    {
        return 'boxconfig_boxbundle_configurationtype';
    }
}
