<?php
namespace App\Service;
use App\Entity\LikePage;

class LikePageService
{
    private $entityManager;
    private $likePageDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->likePageDb = $this->entityManager->getRepository(LikePage::class);
    }

    public function getNumber($page): int
    {
        return $this->likePageDb->getNumber($page);
    }
}