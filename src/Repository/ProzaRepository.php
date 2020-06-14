<?php

namespace App\Repository;

use App\Entity\Proza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Proza|null find($id, $lockMode = null, $lockVersion = null)
 * @method Proza|null findOneBy(array $criteria, array $orderBy = null)
 * @method Proza[]    findAll()
 * @method Proza[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProzaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proza::class);
    }

    // /**
    //  * @return Proza[] Returns an array of Proza objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Proza
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
