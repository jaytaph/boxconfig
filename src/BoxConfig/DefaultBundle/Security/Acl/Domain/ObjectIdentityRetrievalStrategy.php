<?php
/*
 * Taken from http://jonathaningram.com.au/2012/01/13/overriding-the-objectidentityretrievalstrategy-to-check-if-a-domain-object-is-a-doctrine-proxy/
 */
namespace BoxConfig\DefaultBundle\Security\Acl\Domain;

use Symfony\Component\Security\Acl\Exception\InvalidDomainObjectException;
use Symfony\Component\Security\Acl\Model\ObjectIdentityRetrievalStrategyInterface;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;

use Doctrine\ORM\EntityManager;

/**
 * Strategy to be used for retrieving object identities from domain objects
 * where the domain object may be a Doctrine proxy.
 */
class ObjectIdentityRetrievalStrategy implements ObjectIdentityRetrievalStrategyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager $em
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public function getObjectIdentity($domainObject)
    {
        try {
            if ($domainObject instanceof \Doctrine\ORM\Proxy\Proxy) {
                return $this->fromDomainObject($domainObject);
            }

            return ObjectIdentity::fromDomainObject($domainObject);
        } catch (InvalidDomainObjectException $failed) {
            return null;
        }
    }

    private function fromDomainObject($domainObject)
    {
        if (!is_object($domainObject)) {
            throw new InvalidDomainObjectException('$domainObject must be an object.');
        }

        try {
            if ($domainObject instanceof DomainObjectInterface) {
                return new ObjectIdentity($domainObject->getObjectIdentifier(), $this->em->getClassMetadata(get_class($domainObject))->getName());
            } elseif (method_exists($domainObject, 'getId')) {
                return new ObjectIdentity($domainObject->getId(), $this->em->getClassMetadata(get_class($domainObject))->getName());
            }
        } catch (\InvalidArgumentException $invalid) {
            throw new InvalidDomainObjectException($invalid->getMessage(), 0, $invalid);
        }

        throw new InvalidDomainObjectException('$domainObject must either implement the DomainObjectInterface, or have a method named "getId".');
    }
}