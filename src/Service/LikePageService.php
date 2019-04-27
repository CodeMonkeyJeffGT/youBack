<?php
namespace App\Service;
use App\Entity\LikePage;

class LikePageService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}