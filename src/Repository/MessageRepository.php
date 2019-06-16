<?php

namespace App\Repository;

use App\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function list($user)
    {
        $sql = 'SELECT `u`.`id`,`u`.`nickname`,`u`.`sex`,`u`.`headpic`,`u`.`sign`,`u`.`created`,`s`.`name` `school_name`, `s`.`id` `school_id`
            FROM `user` `u`, `school` `s`
        ';
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array());
        $users = $stmt->fetchAll();
        return $users;
    }

    public function detail($user, $to)
    {
        $sql = 'SELECT `m`.`id`, `m`.`user_id`, `m`.`content`, `m`.`created`, `ut`.`nickname` `nickname`, `ut`.`headpic` `headpic`
            FROM `user` `u`, `message` `m`, `user` `ut`
            WHERE (
                `m`.`user_id` = ' . $user->getId() . '
                AND 
                `m`.`sender_id` = ' . $to->getId() . '
                AND
                `u`.`id` = `m`.`user_id`
                AND
                `ut`.`id` = `m`.`user_id`
            )
            OR
            (
                `m`.`user_id` = ' . $to->getId() . '
                AND 
                `m`.`sender_id` = ' . $user->getId() . '
                AND
                `u`.`id` = `m`.`sender_id`
                AND
                `ut`.`id` = `m`.`user_id`
            )
        ';
        $conn = $this->getEntityManager()->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->execute(array());
        $msgs = $stmt->fetchAll();
        return $msgs;
    }

    public function send($user, $to, $content)
    {
        $entityManager = $this->getEntityManager();
        $message = new Message();
        $message->setType(0)
            ->setUser($user)
            ->setSender($to)
            ->setContent($content)
            ->setCreated(new \DateTime('NOW'))
        ;
        $entityManager->persist($message);
        $entityManager->flush();
        return $message;
    }

    // /**
    //  * @return Message[] Returns an array of Message objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Message
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
