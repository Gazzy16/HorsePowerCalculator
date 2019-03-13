<?php

namespace App\Repository;

use App\Entity\EngineTuned;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EngineTuned|null find($id, $lockMode = null, $lockVersion = null)
 * @method EngineTuned|null findOneBy(array $criteria, array $orderBy = null)
 * @method EngineTuned[]    findAll()
 * @method EngineTuned[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EngineTunedRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EngineTuned::class);
    }

    // /**
    //  * @return EngineTuned[] Returns an array of EngineTuned objects
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

    public function findAllByUserId($id): ?EngineTuned
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.usertuned = :usertuned_id')
            ->setParameter('usertuned_id', $id)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
        ;
    }
}
