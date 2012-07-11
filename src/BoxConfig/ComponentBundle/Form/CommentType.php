<?php

namespace BoxConfig\ComponentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('rating', 'choice', array('choices'   => range(0, 10),  'empty_value' => 'Choose a rating', 'attr'=>array('rows' => '10', 'cols' =>'20')))
            ->add('comment')
        ;
    }

    public function getName()
    {
        return 'boxconfig_ComponentBundle_commenttype';
    }
}
