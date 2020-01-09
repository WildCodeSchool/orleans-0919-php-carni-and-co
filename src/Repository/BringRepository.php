<?php

namespace App\Repository;

use App\Entity\Bring;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Bring|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bring|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bring[]    findAll()
 * @method Bring[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BringRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bring::class);
    }
}
