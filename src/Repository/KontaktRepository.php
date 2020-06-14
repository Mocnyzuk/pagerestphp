<?php

namespace App\Repository;

use App\Entity\Kontakt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Kontakt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Kontakt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Kontakt[]    findAll()
 * @method Kontakt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KontaktRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Kontakt::class);
    }

    // /**
    //  * @return Kontakt[] Returns an array of Kontakt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Kontakt
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
