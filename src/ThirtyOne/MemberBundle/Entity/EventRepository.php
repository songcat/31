<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{

    public function getEvent($region, $date){
        $query = $this->_em->createQuery('SELECT e
            FROM ThirtyOneMemberBundle:Event e
            WHERE e.private = 0
                AND e.region LIKE :region
                AND e.date > :date')
            ->setParameter('region', $region)
            ->setParameter('date', $date);
        $result = $query->getResult();

        return $result;
    }
}