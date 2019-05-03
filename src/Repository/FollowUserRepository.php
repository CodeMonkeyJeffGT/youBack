<?php

namespace App\Repository;

use App\Entity\FollowUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FollowUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method FollowUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method FollowUser[]    findAll()
 * @method FollowUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FollowUser::class);
    }

    public function follows($user): array
    {
        return $this->findBy(array(
            'user' => $user,
        ));
    }

    public function followed($user): array
    {
        return $this->findBy(array(
            'follow' => $user,
        ));
    }

    public function checkFollow($user, $follow)
    {
        $followUser = $this->findOneBy(array(
            'user' => $user,
            'follow' => $follow,
        ));
        return $followUser ?? false;
    }

    public function follow($user, $follow): ?FollowUser
    {
        $entityManager = $this->getEntityManager();
        $followUser = new FollowUser();
        $followUser
            ->setUser($user)
            ->setFollow($follow)
        ;
        $entityManager->persist($followUser);
        $entityManager->flush();
        return $followUser;
    }

    public function unfollow($followUser)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($followUser);
        $entityManager->flush();
    }

    // /**
    //  * @return FollowUser[] Returns an array of FollowUser objects
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
    public function findOneBySomeField($value): ?FollowUser
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
