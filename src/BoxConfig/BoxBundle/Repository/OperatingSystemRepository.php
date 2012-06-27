<?php

namespace BoxConfig\BoxBundle\Repository;

use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\ORM\EntityRepository;

/**
* OperatingSystemRepository
*
*/
class OperatingSystemRepository extends EntityRepository {

    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
        $this->getEntityManager()->getConfiguration()->addCustomHydrationMode('ScalarObjectHydrator', 'BoxConfig\DefaultBundle\Hydrators\ScalarObjectHydrator');
    }

    function getCount()
    {
        return $this->getEntityManager()->createQueryBuilder()
                    ->select('COUNT(os.id)')
                    ->from('BoxConfig\BoxBundle\Entity\OperatingSystem', 'os')
                    ->getQuery()
                    ->getSingleScalarResult();
    }

    /**
     * Returns the top X operating systems plus their percentage. Can also be used to fetch the virtual top OS'es as well
     *
     * @param int $limit
     * @return array
     */
    function getTop($limit = 5, $virtualizedOnly = false) {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('BoxConfig\BoxBundle\Entity\OperatingSystem', 'e');
        $rsm->addScalarResult('percentage', 'percentage');

        $sql = sprintf("SELECT OS1.*,
                            (COUNT( DISTINCT T2.id ) / COUNT( DISTINCT T1.id ) *100) AS percentage
                        FROM
                            environment T1, environment T2, operatingSystem OS1
                        WHERE
                            T2.operatingSystem_id = OS1.id
                            %s
                        GROUP BY
                            OS1.id
                        ORDER BY
                            percentage DESC
                        LIMIT
                            :limit", $virtualizedOnly ? " AND T2.virtualized = 1 " : "");
        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter("limit", $limit);

        return $query->getResult('ScalarObjectHydrator');
    }
}