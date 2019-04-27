<?php

namespace App\Repository;

use App\Entity\LikePage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikePage|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikePage|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikePage[]    findAll()
 * @method LikePage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikePageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikePage::class);
    }

    // /**
    //  * @return LikePage[] Returns an array of LikePage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LikePage
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
