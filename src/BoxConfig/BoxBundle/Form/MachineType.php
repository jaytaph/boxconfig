<?php

namespace BoxConfig\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class MachineType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('hardware')
            ->add('active', 'checkbox', array('required' => false))
            ->add('environments')
        ;
    }

    public function getName()
    {
        return 'boxconfig_boxbundle_machinetype';
    }
}
