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

    public function checkExist($account, $schoolId): bool
    {
        return $this->userDb->checkExist($account, $schoolId);
    }
}