<?php

namespace App\Repository;

use App\Entity\OpenHours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OpenHours|null find($id, $lockMode = null, $lockVersion = null)
 * @method OpenHours|null findOneBy(array $criteria, array $orderBy = null)
 * @method OpenHours[]    findAll()
 * @method OpenHours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OpenHoursRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OpenHours::class);
    }

    // /**
    //  * @return OpenHours[] Returns an array of OpenHours objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OpenHours
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
