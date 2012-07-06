<?php

namespace boxconfig\ComponentBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\ComponentBundle\Entity\OperatingSystem;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class OperatingSystemFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $os1 = new OperatingSystem();
        $os1->setOs("Linux");
        $os1->setDistribution("Debian");
        $os1->setVersion("6.0");
        $os1->setCodeName("Squeeze");
        $os1->setImagePath("debian-logo.png");
        $manager->persist($os1);

        $os2 = new OperatingSystem();
        $os2->setOs("OSX");
        $os2->setCodename("Snow Leopard");
        $os2->setVersion("10.6");
        $os2->setImagePath("osx-snowleopard-logo.jpg");
        $manager->persist($os2);

        $os3 = new OperatingSystem();
        $os3->setOs("OSX");
        $os3->setCodename("Lion");
        $os3->setVersion("10.7");
        $os3->setImagePath("osx-lion-logo.jpg");
        $manager->persist($os3);

        $os4 = new OperatingSystem();
        $os4->setOs("Linux");
        $os4->setDistribution("CentOS");
        $os4->setVersion("6.2");
        $os4->setImagePath("centos-logo.png");
        $manager->persist($os4);

        $os5 = new OperatingSystem();
        $os5->setOs("Microsoft Windows 7");
        $os5->setDistribution("Ultimate");
        $os5->setVersion("7");
        $os5->setImagePath("windows7-logo.png");
        $manager->persist($os5);

        $os6 = new OperatingSystem();
        $os6->setOs("Microsoft Windows 7");
        $os6->setDistribution("Professional");
        $os6->setVersion("7");
        $os6->setImagePath("windows7-logo.png");
        $manager->persist($os6);


        $manager->flush();

        $this->addReference('os-1', $os1);
        $this->addReference('os-2', $os2);
        $this->addReference('os-3', $os3);
        $this->addReference('os-4', $os4);
        $this->addReference('os-5', $os5);
        $this->addReference('os-6', $os6);
    }

    public function getOrder()
    {
        return 10;
    }

}