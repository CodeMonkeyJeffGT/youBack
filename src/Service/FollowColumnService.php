<?php
namespace App\Service;
use App\Entity\FollowColumn;

class FollowColumnService
{
    private $entityManager;
    private $followColumnDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->followColumnDb = $this->entityManager->getRepository(FollowColumn::class);
    }

    public function getFollowNumber($column): int
    {
        return $this->followColumnDb->getFollowNumber($column);
    }
    
    public function list($user): array
    {
        $follows = $this->followColumnDb->follows($user);
        foreach ($follows as $key => $value) {
            $follows[$key] = $value->getAcolumn();
        }
        return $follows;
    }

    public function checkFollow($user, $column): bool
    {
        if ($this->followColumnDb->checkFollow($user, $column) === false) {
            return false;
        } else {
            return true;
        }
    }

    public function follow($user, $column): bool
    {
        if ($this->followColumnDb->checkFollow($user, $column)) {
            return false;
        }
        $this->followColumnDb->follow($user, $column);
        return true;
    }

    public function unfollow($user, $column): bool
    {
        $followColumn = $this->followColumnDb->checkFollow($user, $column);
        if ($followColumn === false) {
            return false;
        }
        $this->followColumnDb->unfollow($followColumn);
        return true;
    }

    public function number($user): int
    {
        $followsNum = count($this->followColumnDb->follows($user));
        return $followsNum;
    }
}