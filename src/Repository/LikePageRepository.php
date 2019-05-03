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

    public function getNumber($page): int
    {
        $qb = $this->createQueryBuilder('l');
        return (int)$qb
            ->andWhere('l.page = :page')
            ->setParameter('page', $page)
            ->select($qb->expr()->count('l.id'))
            ->getQuery()
            ->getResult()[0][1]
        ;
    }

    public function checkLike($user, $page): ?LikePage
    {
        $likePage = $this->findOneBy(array(
            'user' => $user,
            'page' => $page,
        ));
        return $likePage;
    }

    public function likePage($user, $page): ?likePage
    {

        $entityManager = $this->getEntityManager();
        $likePage = new LikePage();
        $likePage
            ->setUser($user)
            ->setPage($page)
        ;
        $entityManager->persist($likePage);
        $entityManager->flush();
        return $likePage;
    }

    public function unlikePage($likePage)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($likePage);
        $entityManager->flush();
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
