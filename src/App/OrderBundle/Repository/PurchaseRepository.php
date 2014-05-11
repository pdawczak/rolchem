<?php

namespace App\OrderBundle\Repository;


use Doctrine\ORM\EntityRepository;

class PurchaseRepository extends EntityRepository
{
    /**
     * @param int $count
     * @return mixed
     */
    public function getLatestOpenPurchases($count = 5)
    {
        $qb = $this->createQueryBuilder('p')
            ->andWhere('p.finished != :finished')
            ->setParameter('finished', true)
            ->orderBy('p.createdAt', 'DESC');

        return $qb->getQuery()->execute();
    }

    /**
     * @return mixed
     */
    public function getCountOfOpen()
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->andWhere('p.finished != :finished')
            ->setParameter('finished', true)
            ->getQuery()
            ->getSingleScalarResult();
    }
} 
