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
        $m1->setName("Skywalker");
        $m1->setDescription("Home laptop");
        $m1->setUser($this->getReference("user-1"));
        $m1->setActive(true);
        $m1->setHardware($this->getReference("hw-1"));
        $manager->persist($m1);
        // @TODO: Add software

        $m2 = new Machine();
        $m2->setName("Vader");
        $m2->setDescription("Work laptop");
        $m2->setUser($this->getReference("user-1"));
        $m2->setActive(true);
        $m2->setHardware($this->getReference("hw-1"));
        $manager->persist($m2);
        // @TODO: Add software

        $m3 = new Machine();
        $m3->setName("Kenobi");
        $m3->setDescription("Home computer");
        $m3->setUser($this->getReference("user-1"));
        $m3->setActive(false);
        $m3->setHardware($this->getReference("hw-3"));
        $manager->persist($m3);
        // @TODO: Add software

        $manager->flush();

        $this->addReference('m-1', $m1);
        $this->addReference('m-2', $m2);
        $this->addReference('m-3', $m3);
    }

    public function getOrder()
    {
        return 50;
    }

}