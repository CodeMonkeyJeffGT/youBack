<?php

namespace App\Repository;

use App\Entity\FollowColumn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FollowColumn|null find($id, $lockMode = null, $lockVersion = null)
 * @method FollowColumn|null findOneBy(array $criteria, array $orderBy = null)
 * @method FollowColumn[]    findAll()
 * @method FollowColumn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowColumnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FollowColumn::class);
    }

    // /**
    //  * @return FollowColumn[] Returns an array of FollowColumn objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FollowColumn
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
