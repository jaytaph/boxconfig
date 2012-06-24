<?php

namespace BoxConfig\DefaultBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class OperatingSystemType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('os')
            ->add('distribution')
            ->add('version')
        ;
    }

    public function getName()
    {
        return 'boxconfig_defaultbundle_operatingsystemtype';
    }
}
