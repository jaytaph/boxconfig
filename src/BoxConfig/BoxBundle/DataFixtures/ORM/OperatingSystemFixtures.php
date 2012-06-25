<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\BoxBundle\Entity\Operatingsystem;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class OperatingsystemFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $os1 = new Operatingsystem();
        $os1->setOs("Linux");
        $os1->setDistribution("Debian");
        $os1->setVersion("6.0 / Squeeze");
        $manager->persist($os1);

        $os2 = new Operatingsystem();
        $os2->setOs("Mac OSX");
        $os2->setDistribution("Snow Leopard");
        $os2->setVersion("");
        $manager->persist($os2);

        $manager->flush();

        $this->addReference('os-1', $os1);
        $this->addReference('os-2', $os2);
    }

    public function getOrder()
    {
        return 20;
    }

}