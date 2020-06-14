<?php

namespace App\Repository;

use App\Entity\Zabieg;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Zabieg|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zabieg|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zabieg[]    findAll()
 * @method Zabieg[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZabiegRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zabieg::class);
    }

    // /**
    //  * @return Zabieg[] Returns an array of Zabieg objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zabieg
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
