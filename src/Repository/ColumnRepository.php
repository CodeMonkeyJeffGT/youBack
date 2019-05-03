<?php

namespace App\Repository;

use App\Entity\Columns;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Column|null find($id, $lockMode = null, $lockVersion = null)
 * @method Column|null findOneBy(array $criteria, array $orderBy = null)
 * @method Column[]    findAll()
 * @method Column[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColumnRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Columns::class);
    }

    public function listColumns($query, $lastId, $limit): array
    {
        $tmp = $this->createQueryBuilder('c')
            ->andWhere('c.name like :query')
            ->setParameter('query', $query)
            ->setMaxResults($limit)
        ;
        if ( ! empty($lastId)) {
            $tmp->andWhere('c.id > :id')
                ->setParameter('id', $lastId)
            ;
        }
        return $tmp->getQuery()
            ->getResult()
        ;
    }

    public function searchByName($name): ?Columns
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function apply($user, $name, $description): ?Columns
    {
        $entityManager = $this->getEntityManager();
        $column = new Columns();
        $column->setName($name)
            ->setDescription($description)
            ->setCreated(new \DateTime('NOW'))
            ->setType(2)
            ->setOwner($user)
        ;
        $entityManager->persist($column);
        $entityManager->flush();
        return $column;
    }

    public function updateInfo($column, $description): Columns
    {
        $entityManager = $this->getEntityManager();
        $column->setDescription($description);
        $entityManager->persist($column);
        $entityManager->flush();
        return $column;
    }

    // /**
    //  * @return Column[] Returns an array of Column objects
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
    public function findOneBySomeField($value): ?Column
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
