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

    public function getFollowNumber($column)
    {
        return $this->followColumnDb->getFollowNumber($column);
    }
}