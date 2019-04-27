<?php
namespace App\Service;
use App\Entity\PageComment;

class PageCommentService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}