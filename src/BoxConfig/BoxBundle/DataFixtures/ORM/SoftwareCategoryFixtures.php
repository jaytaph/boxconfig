<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\BoxBundle\Entity\SoftwareCategory;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class SoftwareCategoryFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $cat1 = new SoftwareCategory();
        $cat1->setName("IDE");
        $manager->persist($cat1);

        $cat2 = new SoftwareCategory();
        $cat2->setName("PHP");
        $cat2->setParent($cat1);
        $manager->persist($cat2);

        $cat3 = new SoftwareCategory();
        $cat3->setName("Editor");
        $manager->persist($cat3);

        $manager->flush();

        $this->addReference('cat-1', $cat1);
        $this->addReference('cat-2', $cat2);
        $this->addReference('cat-3', $cat3);
    }

    public function getOrder()
    {
        return 10;
    }

}