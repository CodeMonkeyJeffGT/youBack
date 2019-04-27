<?php
namespace App\Service;
use App\Entity\FollowColumn;

class FollowColumnService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}