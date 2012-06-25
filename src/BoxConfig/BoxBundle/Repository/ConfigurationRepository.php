<?php

namespace BoxConfig\BoxBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BoxConfig\BoxBundle\Entity\Configuration;

/**
* ConfigurationRepository
*
*/
class ConfigurationRepository extends EntityRepository
{

    function getCount()
    {
        return $this->getEntityManager()->createQueryBuilder()
                    ->select('COUNT(c.id)')
                    ->from('BoxConfig\BoxBundle\Entity\Configuration', 'c')
                    ->getQuery()
                    ->getSingleScalarResult();
    }

}

