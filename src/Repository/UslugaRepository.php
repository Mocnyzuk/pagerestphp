<?php

namespace App\Repository;

use App\Entity\Usluga;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usluga|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usluga|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usluga[]    findAll()
 * @method Usluga[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UslugaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usluga::class);
    }

    // /**
    //  * @return Usluga[] Returns an array of Usluga objects
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
    public function findOneBySomeField($value): ?Usluga
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
