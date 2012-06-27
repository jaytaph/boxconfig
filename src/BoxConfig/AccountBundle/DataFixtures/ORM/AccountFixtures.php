<?php

namespace boxconfig\AccountBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\AccountBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class FixtureLoader extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $manager) {
        $user1 = new User();
        $user1->setUsername("demo");
        $user1->setEmail("johndoe@example.org");
        $user1->setPlainPassword("demo");
        $user1->setFullname("John Doe");
        $user1->setEnabled(true);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername("admin");
        $user2->setEmail("imaadmin@example.org");
        $user2->setPlainPassword("admin");
        $user2->setRoles(array(User::ROLE_SUPER_ADMIN));
        $user2->setFullname("Ima Administrator");
        $user2->setEnabled(true);
        $manager->persist($user2);

        $manager->flush();

        $this->addReference('user-1', $user1);
        $this->addReference('user-2', $user2);
    }

    public function getOrder()
    {
        return 10;
    }

}