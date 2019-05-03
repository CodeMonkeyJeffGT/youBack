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

    public function getClassifications($column): array
    {
        return $this->findBy(array(
            'column_owned' => $column,
        ));
    }

    public function insArr($column, $ins)
    {
        $entityManager = $this->getEntityManager();
        foreach ($ins as $value) {
            $classification = new ColumnClassification();
            $classification->setColumnOwned($column)
                ->setName($value)
                ->setRemovable(true)
            ;
            $entityManager->persist($classification);
        }
        $entityManager->flush();
    }

    public function delArr($column, $del)
    {
        $entityManager = $this->getEntityManager();
        foreach ($del as $value) {
            $entityManager->remove($value);
        }
        $entityManager->flush();
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
