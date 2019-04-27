<?php

namespace App\Repository;

use App\Entity\ColumnClassification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ColumnClassification|null find($id, $lockMode = null, $lockVersion = null)
 * @method ColumnClassification|null findOneBy(array $criteria, array $orderBy = null)
 * @method ColumnClassification[]    findAll()
 * @method ColumnClassification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColumnClassificationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ColumnClassification::class);
    }

    // /**
    //  * @return ColumnClassification[] Returns an array of ColumnClassification objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ColumnClassification
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
