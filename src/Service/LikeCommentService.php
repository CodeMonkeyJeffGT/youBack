<?php
namespace App\Service;
use App\Entity\LikeComment;

class LikeCommentService
{
    private $entityManager;
    private $likeCommentDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->likeCommentDb = $this->entityManager->getRepository(LikeComment::class);
    }

    public function getNum($page): int
    {
        
    }
}