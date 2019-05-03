<?php

namespace App\Repository;

use App\Entity\CollectPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CollectPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectPage[]    findAll()
 * @method CollectPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectPageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CollectPage::class);
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

    public function list($user): array
    {
        return $this->findBy(array(
            'user' => $user,
        ));
    }

    public function checkCollect($user, $page): ?collectPage
    {
        $collectPage = $this->findOneBy(array(
            'user' => $user,
            'page' => $page,
        ));
        return $collectPage;
    }

    public function collectPage($user, $page): ?collectPage
    {

        $entityManager = $this->getEntityManager();
        $collectPage = new collectPage();
        $collectPage
            ->setUser($user)
            ->setPage($page)
        ;
        $entityManager->persist($collectPage);
        $entityManager->flush();
        return $collectPage;
    }

    public function uncollectPage($collectPage)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($collectPage);
        $entityManager->flush();
    }

    // /**
    //  * @return CollectPage[] Returns an array of CollectPage objects
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
    public function findOneBySomeField($value): ?CollectPage
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
