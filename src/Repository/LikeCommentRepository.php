<?php

namespace App\Repository;

use App\Entity\LikeComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LikeComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method LikeComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method LikeComment[]    findAll()
 * @method LikeComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikeCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LikeComment::class);
    }

    public function getNumber($comment): int
    {
        $qb = $this->createQueryBuilder('l');
        return (int)$qb
            ->andWhere('l.comment = :comment')
            ->setParameter('comment', $comment)
            ->select($qb->expr()->count('l.id'))
            ->getQuery()
            ->getResult()[0][1]
        ;
    }

    public function checkLike($user, $comment): ?LikeComment
    {
        $likeComment = $this->findOneBy(array(
            'user' => $user,
            'comment' => $comment,
        ));
        return $likeComment;
    }

    public function likeComment($user, $comment): ?likeComment
    {

        $entityManager = $this->getEntityManager();
        $likeComment = new LikeComment();
        $likeComment
            ->setUser($user)
            ->setComment($comment)
        ;
        $entityManager->persist($likeComment);
        $entityManager->flush();
        return $likeComment;
    }

    public function unlikeComment($likeComment)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($likeComment);
        $entityManager->flush();
    }

    // /**
    //  * @return LikeComment[] Returns an array of LikeComment objects
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
    public function findOneBySomeField($value): ?LikeComment
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
