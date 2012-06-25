<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\BoxBundle\Entity\Configuration;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class ConfigurationFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $cfg1 = new Configuration();
        $cfg1->setUser($this->getReference('user-1'));
        $cfg1->setVirtualized(false);
        $cfg1->setOperatingsystem($this->getReference('os-2'));
        $cfg1->setMachine($this->getReference('m-1'));
        $manager->persist($cfg1);

        $cfg2 = new Configuration();
        $cfg2->setVirtualized(true);
        $cfg2->setOperatingsystem($this->getReference('os-1'));
        $manager->persist($cfg2);

        $manager->flush();
    }

    public function getOrder()
    {
        return 40;
    }

}