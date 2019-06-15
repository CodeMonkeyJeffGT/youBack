<?php

namespace App\Repository;

use App\Entity\Page;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Page|null find($id, $lockMode = null, $lockVersion = null)
 * @method Page|null findOneBy(array $criteria, array $orderBy = null)
 * @method Page[]    findAll()
 * @method Page[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Page::class);
    }

    public function changeClassToNullByClass($class)
    {
        $pages = $this->findBy(array(
            'classification' => $class,
        ));
        $entityManager = $this->getEntityManager();
        foreach ($pages as $value) {
            $value->setClassification(null);
            $entityManager->persist($value);
        }
        $entityManager->flush();
    }

    public function getNumber($column): int
    {
        $qb = $this->createQueryBuilder('p');
        return (int)$qb
            ->andWhere('p.acolumn = :acolumn')
            ->setParameter('acolumn', $column)
            ->select($qb->expr()->count('p.id'))
            ->getQuery()
            ->getResult()[0][1]
        ;
    }

    public function listUserPages($user, $lastId, $limit): array
    {
        $tmp = $this->createQueryBuilder('p')
            ->andWhere('p.user = :user')
            ->setParameter('user', $user)
            ->setMaxResults($limit)
        ;
        if ( ! empty($lastId)) {
            $tmp->andWhere('p.id > :id')
                ->setParameter('id', $lastId)
            ;
        }
        return $tmp->getQuery()
            ->getResult()
        ;
    }

    public function info($id): ?deletePage
    {
        $rst = $this->find($id);
        return $rst;
    }

    public function listPages($column, $class, $query, $lastId, $limit): array
    {
        $tmp = $this->createQueryBuilder('p')
            ->andWhere('p.name like :query')
            ->setParameter('query', $query)
            ->setMaxResults($limit)
        ;
        if ( ! empty($column)) {
            $tmp->andWhere('p.acolumn = :column')
                ->setParameter('column', $column)
            ;
        } elseif ($column === 0) {
            $tmp->andWhere('p.acolumn IS NULL')
            ;
        }
        if ( ! empty($column)) {
            $tmp->andWhere('p.classification = :class')
                ->setParameter('class', $class)
            ;
        } elseif ($class === 0) {
            $tmp->andWhere('p.classification IS NULL')
            ;
        }
        if ( ! empty($lastId)) {
            $tmp->andWhere('p.id > :id')
                ->setParameter('id', $lastId)
            ;
        }
        return $tmp->getQuery()
            ->getResult()
        ;
    }

    public function publish($user, $column, $columnClass, $name, $content): Page
    {
        $entityManager = $this->getEntityManager();
        $page = new Page();
        $page->setName($name)
            ->setUser($user)
            ->setAcolumn($column)
            ->setClassification($columnClass)
            ->setName($name)
            ->setContent($content)
            ->setCreated(new \DateTime('NOW'))
        ;
        $entityManager->persist($page);
        $entityManager->flush();
        return $page;
    }

    public function deletePage($page)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($page);
        $entityManager->flush();
    }

    // /**
    //  * @return Page[] Returns an array of Page objects
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
    public function findOneBySomeField($value): ?Page
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
