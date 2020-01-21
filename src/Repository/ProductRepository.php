<?php

namespace App\Repository;

use App\Entity\Animal;
use App\Entity\Brand;
use App\Entity\Bring;
use App\Entity\Food;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByBrand(?Brand $brand, ?Food $food, ?Animal $animal, ?string $reference, $note)
    {
        $query = $this->createQueryBuilder('p');
        if ($brand) {
            $query->andWhere('p.brand = :brand')
                ->setParameter('brand', $brand);
        }
        if ($food) {
            $query->andWhere('p.food = :food')
                ->setParameter('food', $food);
        }
        if ($animal) {
            $query->andWhere('p.animal = :animal')
                ->setParameter('animal', $animal);
        }
        if ($reference) {
            $query->andWhere('p.reference LIKE :reference')
                ->setParameter('reference', '%' . $reference . '%');
        }
        if ($note) {
            $query->orderBy('p.note', $note);
        }
        $query->addOrderBy('p.reference', 'ASC');
        $query = $query->getQuery();
        return $query->execute();
    }

    public function findByReference(string $reference)
    {
        $query = $this->createQueryBuilder('p')
            ->andWhere('p.reference LIKE :reference')
            ->setParameter('reference', '%' . $reference . '%');
        $query = $query->getQuery();
        return $query->execute();
    }
}
