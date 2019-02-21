<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    // /**
    //  * @return Users[] Returns an array of Users objects
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
    public function findOneBySomeField($value): ?Users
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findOneByUsernamePasswordEmail($username, $password, $email): ?User
    {
        return $this->createQueryBuilder('u')
        ->andWhere('u.username = :username')
        ->setParameter('username', $username)
        ->andWhere('u.password = :pass')
        ->setParameter('pass', $password)
        ->andWhere('u.email = :email')
        ->setParameter('email', $email)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
    
    public function findOneByUsernamePassword($username, $password): ?User
    {
        return $this->createQueryBuilder('u')
        ->andWhere('u.username = :username')
        ->setParameter('username', $username)
        ->andWhere('u.password = :pass')
        ->setParameter('pass', $password)
        ->getQuery()
        ->getOneOrNullResult()
        ;
    }
}
