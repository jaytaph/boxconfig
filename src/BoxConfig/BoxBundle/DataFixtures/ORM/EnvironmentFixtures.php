<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\BoxBundle\Entity\Environment;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class EnvironmentFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $env1 = new Environment();
        $env1->setMachine($this->getReference("m-1"));
        $env1->setOperatingSystem($this->getReference("os-1"));
        $env1->setVirtualized(false);
        $manager->persist($env1);

        $env2 = new Environment();
        $env2->setMachine($this->getReference("m-1"));
        $env2->setOperatingSystem($this->getReference("os-2"));
        $env2->setVirtualized(true);
        $manager->persist($env2);

        $env3 = new Environment();
        $env3->setMachine($this->getReference("m-2"));
        $env3->setOperatingSystem($this->getReference("os-3"));
        $env3->setVirtualized(false);
        $manager->persist($env3);

        $manager->flush();
    }

    public function getOrder()
    {
        return 60;
    }

}