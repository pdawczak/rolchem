<?php

namespace App\ProductBundle\Repository;


use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    public function getCount()
    {
        return $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->getQuery()
            ->getSingleScalarResult();
    }
} 
