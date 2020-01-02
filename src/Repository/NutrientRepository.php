<?php

namespace App\Repository;

use App\Entity\Nutrient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Nutrient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nutrient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nutrient[]    findAll()
 * @method Nutrient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NutrientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nutrient::class);
    }
}
