<?php

namespace BoxConfig\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityRepository;

class SoftwareCategoryType extends AbstractType
{
    // Add the current category entity so the formbuilder can know about it
    function __construct(\BoxConfig\BoxBundle\Entity\SoftwareCategory $category)
    {
        $this->category = $category;

    }


    public function buildForm(FormBuilder $builder, array $options)
    {
        $category = $this->category;
        $builder
            ->add('name')
            ->add('parent', 'entity', array(
                // Tell it which class this entity is
                'class' => 'BoxConfig\BoxBundle\Entity\SoftwareCategory',
                // Get all categories (except the current category)
                'query_builder' => function(EntityRepository $er) use ($category) {
                    return $er->createQueryBuilder('sc')->orderBy('sc.name', 'ASC')->where('sc.id != '. $category->getId());
                },
                // Add and prefer no parent
                'empty_value' => "<none>",
                'preferred_choices' => array("<none>"),
                'empty_data'  => null,

                // Since null is an option, this field should not be required
                'required' => false,
            ));
    }

    public function getName()
    {
        return 'boxconfig_boxbundle_softwarecategorytype';
    }
}
