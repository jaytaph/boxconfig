<?php

namespace BoxConfig\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EnvironmentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('operatingsystem')
            ->add('virtualized', null, array('required' => false));
    }

    public function getName()
    {
        return 'boxconfig_boxbundle_environmenttype';
    }
}
