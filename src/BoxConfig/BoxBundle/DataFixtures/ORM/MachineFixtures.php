<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Boxconfig\BoxBundle\Entity\Machine;
use BoxConfig\AccountBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;


class MachineFixtureLoader extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $m1 = new Machine();
        $m1->setName("Skywalker");
        $m1->setDescription("Home laptop");
        $m1->setUser($this->getReference("user-1"));
        $m1->setActive(true);
        $m1->setHardware($this->getReference("hw-1"));
        $manager->persist($m1);

        $m2 = new Machine();
        $m2->setName("Vader");
        $m2->setDescription("Work laptop");
        $m2->setUser($this->getReference("user-1"));
        $m2->setActive(true);
        $m2->setHardware($this->getReference("hw-2"));
        $manager->persist($m2);

        $m3 = new Machine();
        $m3->setName("Kenobi");
        $m3->setDescription("Home computer");
        $m3->setUser($this->getReference("user-1"));
        $m3->setActive(false);
        $m3->setHardware($this->getReference("hw-4"));
        $manager->persist($m3);

        $manager->flush();

        // Make sure you add ACL's AFTER you have flushed. Otherwise getID() is empty and will fail.
        $this->assignAcl($m1, $m1->getUser());
        $this->assignAcl($m2, $m2->getUser());
        $this->assignAcl($m3, $m3->getUser());

        $this->addReference('m-1', $m1);
        $this->addReference('m-2', $m2);
        $this->addReference('m-3', $m3);
    }

    public function getOrder()
    {
        return 50;
    }


    private function assignAcl($entity, User $user) {
        $em = $this->container->get('doctrine')->getEntityManager();
        $user = $em->getRepository("BoxConfigAccountBundle:User")->findOneById($user->getId());

        // create the ACL
        $aclProvider = $this->container->get('security.acl.provider');
        $objectIdentity = ObjectIdentity::fromDomainObject($entity);
        $acl = $aclProvider->createAcl($objectIdentity);

        // Add operator (owner)
        // Make sure you add the actual class, otherwise it will use the proxy class!
        $securityIdentity = new UserSecurityIdentity($user, 'BoxConfig\AccountBundle\Entity\User');
        $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OPERATOR);

        // Add role admin
        $roleSecurityIdentity = new RoleSecurityIdentity('ROLE_ADMIN');
        $acl->insertObjectAce($roleSecurityIdentity, MaskBuilder::MASK_MASTER);
        $aclProvider->updateAcl($acl);
    }

}