<?php

namespace App\Repository;

use App\Entity\EngineStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EngineStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method EngineStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method EngineStock[]    findAll()
 * @method EngineStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EngineStockRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EngineStock::class);
    }

    // /**
    //  * @return EngineStock[] Returns an array of EngineStock objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EngineStock
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllByUserId($id): ?EngineStock
    {
        return $this->createQueryBuilder('e')
        ->andWhere('e.userstock = :userstock')
        ->setParameter('userstock', $id)
        ->orderBy('e.id', 'ASC')
        ->setMaxResults(100)
        ->getQuery()
        ->getResult()
        ;
    }
}
