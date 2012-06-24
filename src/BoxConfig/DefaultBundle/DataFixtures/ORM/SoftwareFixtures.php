<?php

namespace boxconfig\DefaultBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\DefaultBundle\Entity\Software;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class SoftwareFixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager)
    {
        $app1 = new Software();
        $app1->setName("PHPStorm");
        $app1->setManufacturer("JetBrains");
        $app1->setUrl("http://www.jetbrains.com/phpstorm/");
        $app1->setDescription("Awesome PHP editor");
        $app1->setCategory($this->getReference("cat-2"));
        $app1->setOpenSource(false);
        $app1->setDemo(true);
        $manager->persist($app1);

        $manager->flush();
    }

    public function getOrder()
    {
        return 70;
    }

}