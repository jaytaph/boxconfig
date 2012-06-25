<?php

namespace BoxConfig\BoxBundle\Repository;

use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\EntityRepository;

/**
* OperatingsystemRepository
*
*/
class OperatingsystemRepository extends EntityRepository
{

    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->getEntityManager()->getConfiguration()->addCustomHydrationMode('ScalarObjectHydrator', 'BoxConfig\DefaultBundle\Hydrators\ScalarObjectHydrator');
    }

    function getTop($limit = 5) {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('BoxConfig\BoxBundle\Entity\Configuration', 'c');
        //$rsm->addJoinedEntityFromClassMetadata('BoxConfig\BoxBundle\Entity\Operatingsystem', 'os', 'c', 'operatingsystem');
        $rsm->addScalarResult('percentage', 'percentage');

        $query = $this->_em->createNativeQuery("
            SELECT
                T2.*,
                (COUNT( DISTINCT T2.id ) / COUNT( DISTINCT T1.id ) * 100) AS percentage
            FROM
                configuration T1, configuration T2
            GROUP BY
                T2.operatingsystem_id
            LIMIT
                :limit", $rsm);
        $query->setParameter("limit", $limit);

        return $query->getResult('ScalarObjectHydrator');
    }
}

