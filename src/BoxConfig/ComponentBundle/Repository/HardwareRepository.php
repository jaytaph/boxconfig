<?php

namespace BoxConfig\ComponentBundle\Repository;

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

    function getSelectList()
    {
        $hardware = $this->findAll();

        $list= array();
        foreach ($hardware as $item) {
            $cat = substr($item->getName(), 0, 1);

            if (!isset($list[$cat])) {
                $list[$cat] = array();
            }
            $list[$cat][] = $item;
        }
        return $list;
    }

    function getCount()
    {
        return $this->getEntityManager()->createQueryBuilder()
                    ->select('COUNT(h.id)')
                    ->from('BoxConfig\ComponentBundle\Entity\Hardware', 'h')
                    ->getQuery()
                    ->getSingleScalarResult();
    }

    /**
     * Returns the top X hardware plus their percentage (ie: if half the configurations are based on MacBook, it will return 50%)
     *
     * @param int $limit
     * @return array
     */
    function getTop($limit = 5) {
        $rsm = new ResultSetMappingBuilder($this->getEntityManager());
        $rsm->addRootEntityFromClassMetadata('BoxConfig\ComponentBundle\Entity\Hardware', 'h');
        $rsm->addScalarResult('percentage', 'percentage');

        $query = $this->_em->createNativeQuery("
            SELECT H1.*,
                (COUNT( DISTINCT T2.id ) / COUNT( DISTINCT T1.id ) *100) AS percentage
            FROM
                environment T1, environment T2, machine M1, hardware H1
            WHERE
                T2.machine_id = M1.id AND M1.hardware_id = H1.id
            GROUP BY
                H1.id
            ORDER BY
                percentage DESC
            LIMIT
                :limit", $rsm);
        $query->setParameter("limit", $limit);

        return $query->getResult('ScalarObjectHydrator');
    }
}

