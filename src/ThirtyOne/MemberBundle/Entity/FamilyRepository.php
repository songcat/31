<?php

namespace ThirtyOne\MemberBundle\Entity;

use Doctrine\ORM\EntityRepository;

class FamilyRepository extends EntityRepository
{

    public function getFamily($family, $region, $id)
    {
        if ($family && $region) {
            $query = $this->_em->createQuery('SELECT f
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.username LIKE :name
                AND f.region LIKE :region
                AND f.id != :fam
                AND f.publish = 1')
                ->setParameter('name', $family)
                ->setParameter('region', $region)
                ->setParameter('fam', $id);
        } else {
            $query = $this->_em->createQuery('SELECT f
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.publish = 1
                AND f.id != :fam
                AND (f.username LIKE :name
                OR f.region LIKE :region)')
                ->setParameter('name', $family)
                ->setParameter('region', $region)
                ->setParameter('fam', $id);
        }
        $result = $query->getResult();

        return $result;
    }

    public function homeFamily($region, $id)
    {
        return $query = $this->_em->createQuery('SELECT f
            FROM ThirtyOneMemberBundle:Family f
            WHERE f.region LIKE :region
                AND f.id != :fam
                AND f.publish = 1')
            ->setParameter('region', $region)
            ->setParameter('fam', $id)
            ->setMaxResults(3)
            ->getResult();
    }
}