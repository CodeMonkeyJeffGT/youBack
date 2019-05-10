<?php
namespace App\Service;
use App\Entity\User;

class UserService
{
    private $entityManager;
    private $userDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->userDb = $this->entityManager->getRepository(User::class);
    }

    public function getUser($id): ?User
    {
        return $this->userDb->find($id);
    }

    public function checkExist($account, $schoolId): ?User
    {
        return $this->userDb->checkExist($account, $schoolId);
    }

    public function insert($account, $schoolId, $name, $sex): User
    {
        return $this->userDb->insert($account, $schoolId, $name, $sex);
    }

    public function updateLastPassword($user, $password): User
    {
        return $this->userDb->updateLastPassword($user, $password);
    }

    public function search($query, $lastId, $limit): array
    {
        if ($query !== '') {
            $arr = array();
            for ($i = 0, $len = mb_strlen($query); $i < $len; $i++)
            {
                $arr[] = mb_substr($query, $i, 1);
            }
            $query = '%' . implode('%', $arr) . '%';
        }
        if ($query === '') {
            $query = '%';
        }
        $users = $this->userDb->listUsers($query, $lastId, $limit);
        return $users;
    }
}