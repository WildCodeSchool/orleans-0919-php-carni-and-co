<?php

namespace App\Repository;

use App\Entity\NutrientType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method NutrientType|null find($id, $lockMode = null, $lockVersion = null)
 * @method NutrientType|null findOneBy(array $criteria, array $orderBy = null)
 * @method NutrientType[]    findAll()
 * @method NutrientType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NutrientTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NutrientType::class);
    }
}
