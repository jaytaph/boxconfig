<?php

namespace boxconfig\ComponentBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\ComponentBundle\Entity\Hardware;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class HardwareFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $hw1 = new Hardware();
        $hw1->setName("MacBook Pro 13\"");
        $hw1->setImagePath("macbookpro13inch.jpg");
        $manager->persist($hw1);

        $hw2 = new Hardware();
        $hw2->setName("MacBook Pro 15\"");
        $hw2->setImagePath("macbookpro15inch.jpg");
        $manager->persist($hw2);

        $hw3 = new Hardware();
        $hw3->setName("MacBook Pro 17\"");
        $hw3->setImagePath("macbookpro17inch.jpg");
        $manager->persist($hw3);

        $hw4 = new Hardware();
        $hw4->setName("Lenovo t520");
        $hw4->setImagePath("Lenovo-Thinkpad-T520.jpg");
        $manager->persist($hw4);

        $hw5 = new Hardware();
        $hw5->setName("HP Probook");
        $hw5->setImagePath("HP-ProBook-4420s.jpg");
        $manager->persist($hw5);

        $manager->flush();

        $this->addReference('hw-1', $hw1);
        $this->addReference('hw-2', $hw2);
        $this->addReference('hw-3', $hw3);
        $this->addReference('hw-4', $hw4);
        $this->addReference('hw-5', $hw5);
    }

    public function getOrder()
    {
        return 10;
    }

}