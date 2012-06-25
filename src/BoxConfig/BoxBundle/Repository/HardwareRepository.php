<?php

namespace BoxConfig\BoxBundle\Repository;

use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\EntityRepository;

/**
* HardwareRepository
*
*/
class HardwareRepository extends EntityRepository
{

    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->getEntityManager()->getConfiguration()->addCustomHydrationMode('ScalarObjectHydrator', 'BoxConfig\DefaultBundle\Hydrators\ScalarObjectHydrator');
    }

    function getTop($limit = 5) {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('BoxConfig\BoxBundle\Entity\Hardware', 'h');
        $rsm->addScalarResult('percentage', 'percentage');


        /**
         SELECT T2. * , (
         COUNT( DISTINCT T2.id ) / COUNT( DISTINCT T1.id ) *100
         ) AS percentage
         FROM configuration T1, configuration T2, machine M1, hardware H1
         WHERE T2.machine_id = M1.id
         AND M1.hardware_id = H1.id
         GROUP BY H1.id
         */
        $query = $this->_em->createNativeQuery("
            SELECT H1.*,
                (COUNT( DISTINCT T2.id ) / COUNT( DISTINCT T1.id ) *100) AS percentage
            FROM
                configuration T1, configuration T2, machine M1, hardware H1
            WHERE
                T2.machine_id = M1.id AND M1.hardware_id = H1.id
            GROUP BY
                H1.id
            LIMIT
                :limit", $rsm);
        $query->setParameter("limit", $limit);

        return $query->getResult('ScalarObjectHydrator');
    }
}

