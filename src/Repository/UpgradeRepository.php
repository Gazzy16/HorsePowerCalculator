<?php

namespace App\Repository;

use App\Entity\Upgrade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Upgrades|null find($id, $lockMode = null, $lockVersion = null)
 * @method Upgrades|null findOneBy(array $criteria, array $orderBy = null)
 * @method Upgrades[]    findAll()
 * @method Upgrades[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpgradeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Upgrade::class);
    }

    // /**
    //  * @return Upgrades[] Returns an array of Upgrades objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Upgrades
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
