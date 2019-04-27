<?php
namespace App\Service;
use App\Entity\FollowUser;

class FollowUserService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}