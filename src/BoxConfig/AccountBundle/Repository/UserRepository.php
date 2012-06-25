<?php

namespace BoxConfig\AccountBundle\Repository;

use Doctrine\ORM\EntityRepository;
use BoxConfig\AccountBundle\Entity\User;

/**
* UserRepository
*
*/
class UserRepository extends EntityRepository
{

    function getCount()
    {
        return $this->getEntityManager()->createQueryBuilder()
                    ->select('COUNT(u.id)')
                    ->from('BoxConfig\AccountBundle\Entity\User', 'u')
                    ->getQuery()
                    ->getSingleScalarResult();
    }

}

