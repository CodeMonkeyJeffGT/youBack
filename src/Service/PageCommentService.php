<?php
namespace App\Service;
use App\Entity\PageComment;

class PageCommentService
{
    private $entityManager;
    private $pageCommentDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->pageCommentDb = $this->entityManager->getRepository(PageComment::class);
    }

    public function getNumber($page): int
    {
        return $this->pageCommentDb->getNumber($page);
    }
}