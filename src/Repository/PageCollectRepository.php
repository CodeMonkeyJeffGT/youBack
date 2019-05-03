<?php

namespace App\Repository;

use App\Entity\PageCollect;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PageCollect|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageCollect|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageCollect[]    findAll()
 * @method PageCollect[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageCollectRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageCollect::class);
    }

    public function getNumber($page): int
    {
        $qb = $this->createQueryBuilder('p');
        return (int)$qb
            ->andWhere('p.page = :page')
            ->setParameter('page', $page)
            ->select($qb->expr()->count('p.id'))
            ->getQuery()
            ->getResult()[0][1]
        ;
    }

    // /**
    //  * @return PageCollect[] Returns an array of PageCollect objects
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
    public function findOneBySomeField($value): ?PageCollect
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
