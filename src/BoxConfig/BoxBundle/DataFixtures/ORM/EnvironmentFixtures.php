<?php

namespace boxconfig\BoxBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use boxconfig\BoxBundle\Entity\Environment;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Domain\RoleSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;

class EnvironmentFixtureLoader extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $env1 = new Environment();
        $env1->setMachine($this->getReference("m-1"));
        $env1->setOperatingSystem($this->getReference("os-2"));
        $env1->setVirtualized(false);
        $manager->persist($env1);

        $env2 = new Environment();
        $env2->setMachine($this->getReference("m-1"));
        $env2->setOperatingSystem($this->getReference("os-1"));
        $env2->setVirtualized(true);
        $manager->persist($env2);

        $env3 = new Environment();
        $env3->setMachine($this->getReference("m-2"));
        $env3->setOperatingSystem($this->getReference("os-3"));
        $env3->setVirtualized(false);
        $manager->persist($env3);

        $env4 = new Environment();
        $env4->setMachine($this->getReference("m-3"));
        $env4->setOperatingSystem($this->getReference("os-5"));
        $env4->setVirtualized(false);
        $manager->persist($env4);

        $env5 = new Environment();
        $env5->setMachine($this->getReference("m-3"));
        $env5->setOperatingSystem($this->getReference("os-1"));
        $env5->setVirtualized(true);
        $manager->persist($env5);


        $manager->flush();

        // Make sure you add ACL's AFTER you have flushed. Otherwise getID() is empty and will fail.
        $this->assignAcl($env1, $env1->getMachine()->getUser());
        $this->assignAcl($env2, $env2->getMachine()->getUser());
        $this->assignAcl($env3, $env3->getMachine()->getUser());
        $this->assignAcl($env4, $env4->getMachine()->getUser());
        $this->assignAcl($env5, $env5->getMachine()->getUser());
    }

    public function getOrder()
    {
        return 60;
    }

    private function assignAcl($entity, $user) {
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