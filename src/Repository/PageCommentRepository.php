<?php

namespace App\Repository;

use App\Entity\PageComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PageComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageComment[]    findAll()
 * @method PageComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageCommentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PageComment::class);
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

    public function list($page): array
    {
        $list = $this->findBy(array(
            'page' => $page,
        ));
        return $list;
    }

    public function publish($user, $page, $content, $reply, $father): PageComment
    {
        $entityManager = $this->getEntityManager();
        $pageComment = new PageComment();
        $pageComment->setPage($page)
            ->setUser($user)
            ->setContent($content)
            ->setReply($reply)
            ->setFather($father)
            ->setCreated(new \DateTime('NOW'))
        ;
        $entityManager->persist($pageComment);
        $entityManager->flush();
        return $pageComment;
    }

    public function deleteComment($pageComment)
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($pageComment);
        $entityManager->flush();
    }

    // /**
    //  * @return PageComment[] Returns an array of PageComment objects
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
    public function findOneBySomeField($value): ?PageComment
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
