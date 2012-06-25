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

    /**

     *
     */

    /**
     * Returns the top X OS plus their percentage (ie: if half the configurations are based on OSX, it will return 50%)
     *
     * @param int $limit Number of items to return
     * @param bool $virtualizedOnly True when we only want virtual OS'es, false if we want ALL OS'es
     * @return array
     */
    function getTop($limit = 5, $virtualizedOnly = false) {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('BoxConfig\BoxBundle\Entity\Configuration', 'c');
        //$rsm->addJoinedEntityFromClassMetadata('BoxConfig\BoxBundle\Entity\Operatingsystem', 'os', 'c', 'operatingsystem');
        $rsm->addScalarResult('percentage', 'percentage');

        $sql = "SELECT
                    T2.*,
                    (COUNT( DISTINCT T2.id ) / COUNT( DISTINCT T1.id ) * 100) AS percentage
                FROM
                    configuration T1, configuration T2 ";
        if ($virtualizedOnly) {
            $sql .= " WHERE T2.virtualized = 1 ";
        }
        $sql .= "
                GROUP BY
                    T2.operatingsystem_id
                ORDER BY
                    percentage DESC
                LIMIT
                    :limit";
        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter("limit", $limit);

        return $query->getResult('ScalarObjectHydrator');
    }
}

