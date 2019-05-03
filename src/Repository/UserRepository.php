<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function insert($account, $school, $name, $sex): User
    {
        $entityManager = $this->getEntityManager();
        $user = new User();
        $user->setAccount($account)
            ->setSchool($school)
            ->setName($name)
            ->setNickname($name)
            ->setSex($sex)
            ->setCreated(new \DateTime('NOW'))
            ->setheadpic('')
            ->setSign('还未设置个签哦')
            ->setLastPassword('');
        $entityManager->persist($user);
        $entityManager->flush();
        return $user;
    }

    public function checkExist($account, $school): ?User
    {
        $user = $this->findOneBy(array(
            'account' => $account,
            'school' => $school,
        ));
        return is_null($user) ? false : $user;
    }

    public function updateLastPassword($user, $password): User
    {
        $entityManager = $this->getEntityManager();
        $user->setLastPassword($password);
        $entityManager->persist($user);
        $entityManager->flush();
        return $user;
    }
}
