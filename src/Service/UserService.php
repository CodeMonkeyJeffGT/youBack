<?php
namespace App\Service;
use App\Entity\User;

class UserService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userDb = $this->entityManager->getRepository(User::class);
    }

    public function getUser($id)
    {
        return $this->userDb->getUser($id);
    }

    public function checkExist($account, $schoolId)
    {
        return $this->userDb->checkExist($account, $schoolId);
    }

    public function insert($account, $schoolId, $name, $sex)
    {
        return $this->userDb->insert($account, $schoolId, $name, $sex);
    }

    public function updateLastPassword($user, $password)
    {
        return $this->userDb->updateLastPassword($user, $password);
    }
}