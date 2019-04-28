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

    public function follows($id)
    {
        return $this->findBy(array(
            'u_id' => $id,
        ));
    }

    public function followed($id)
    {
        return $this->findBy(array(
            'f_id' => $id,
        ));
    }

    public function checkFollow($uId, $fId)
    {
        $followUser = $this->findOneBy(array(
            'u_id' => $uId,
            'f_id' => $fId,
        ));
        return $followUser ?? false;
    }

    public function follow($uId, $fId)
    {
        $entityManager = $this->getEntityManager();
        $followUser = new FollowUser();
        $followUser->setUId($uId)
            ->setFId($fId)
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
