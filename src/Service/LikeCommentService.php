<?php
namespace App\Service;
use App\Entity\LikeComment;

class LikeCommentService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}