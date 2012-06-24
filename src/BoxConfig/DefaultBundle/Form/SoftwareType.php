<?php

namespace BoxConfig\DefaultBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SoftwareType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('manufacturer')
            ->add('description')
            ->add('url')
            ->add('opensource', 'checkbox', array('required' => false))
            ->add('demo', 'checkbox', array('required' => false))
            ->add('opensourcelicense')
            ->add('category')
        ;
    }

    public function getName()
    {
        return 'boxconfig_defaultbundle_softwaretype';
    }
}
