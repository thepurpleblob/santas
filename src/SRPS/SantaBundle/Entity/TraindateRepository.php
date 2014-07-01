<?php

namespace SRPS\SantaBundle\Entity;

use Doctrine\ORM\EntityRepository;

class TraindateRepository extends EntityRepository
{
    public function findAllOrderedByDate()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT d FROM SRPSSantaBundle:Traindate d ORDER BY d.date ASC'
            )
            ->getResult();
    }
}

