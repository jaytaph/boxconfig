<?php

namespace boxconfig\ComponentBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use BoxConfig\ComponentBundle\Entity\HardwareComment;
use BoxConfig\ComponentBundle\Entity\SoftwareComment;
use BoxConfig\ComponentBundle\Entity\OperatingSystemComment;

class CommentFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $c1 = new HardwareComment();
        $c1->setCreated(new \DateTime());
        $c1->setUser($this->getReference("user-2"));
        $c1->setComment("This is really good hardware!");
        $c1->setHardware($this->getReference("hw-1"));
        $c1->setRating(7);
        $manager->persist($c1);

        $c2 = new HardwareComment();
        $c2->setCreated(new \DateTime());
        $c2->setUser($this->getReference("user-1"));
        $c2->setComment("I too like this hardware");
        $c2->setHardware($this->getReference("hw-1"));
        $c2->setRating(8);
        $manager->persist($c2);

        $c3 = new HardwareComment();
        $c3->setCreated(new \DateTime());
        $c3->setUser($this->getReference("user-1"));
        $c3->setComment("I don't like this though.. :(");
        $c3->setHardware($this->getReference("hw-2"));
        $c3->setRating(4);
        $manager->persist($c3);

        $c4 = new OperatingSystemComment();
        $c4->setCreated(new \DateTime());
        $c4->setUser($this->getReference("user-1"));
        $c4->setComment("I love debian!");
        $c4->setOperatingsystem($this->getReference("os-1"));
        $c4->setRating(9);
        $manager->persist($c4);

        $manager->flush();
    }

    public function getOrder()
    {
        return 70;
    }

}