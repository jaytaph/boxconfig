<?php

namespace BoxConfig\BoxBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;
use Doctrine\ORM\EntityManager;

class MachineType extends AbstractType
{
    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilder $builder, array $options)
    {

        $builder
            ->add('name')
            ->add('description')
            ->add('hardware', 'entity', array(
                'class' => 'BoxConfig\ComponentBundle\Entity\Hardware',
                'choices' => $this->em->getRepository('BoxConfigComponentBundle:Hardware')->getSelectList()
                ))
            ->add('active', 'checkbox', array('required' => false))
        ;
    }

    public function getName()
    {
        return 'boxconfig_boxbundle_machinetype';
    }
}
