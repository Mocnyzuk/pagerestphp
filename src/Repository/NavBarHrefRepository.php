<?php

namespace App\Repository;

use App\Entity\NavBarHref;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NavBarHref|null find($id, $lockMode = null, $lockVersion = null)
 * @method NavBarHref|null findOneBy(array $criteria, array $orderBy = null)
 * @method NavBarHref[]    findAll()
 * @method NavBarHref[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NavBarHrefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NavBarHref::class);
    }

    // /**
    //  * @return NavBarHref[] Returns an array of NavBarHref objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NavBarHref
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
