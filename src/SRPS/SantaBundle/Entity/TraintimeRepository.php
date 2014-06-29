<?php

namespace SRPS\SantaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TraintimeRepository extends EntityRepository
{
    public function findAllOrderedByTime()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT t FROM SRPSSantaBundle:Traintime t ORDER BY t.time ASC'
            )
            ->getResult();
    }
}

