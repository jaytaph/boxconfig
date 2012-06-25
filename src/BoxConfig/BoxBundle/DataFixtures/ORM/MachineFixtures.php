<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\BoxBundle\Entity\Machine;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class MachineFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $m1 = new Machine();
        $m1->setName("Macbook Pro 15\"");
        $m1->setDescription("Late 2011 version - Intel Core i7 - 2.2Ghz - 8GB memory");
        $manager->persist($m1);

        $manager->flush();

        $this->addReference('m-1', $m1);
    }

    public function getOrder()
    {
        return 30;
    }

}