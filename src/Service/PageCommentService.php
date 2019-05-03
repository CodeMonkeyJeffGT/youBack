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

    public function getComment($id): ?PageComment
    {
        return $this->pageCommentDb->find($id);
    }

    public function list($page): array
    {
        return $this->pageCommentDb->list($page);
    }

    public function getNumber($page): int
    {
        return $this->pageCommentDb->getNumber($page);
    }

    public function publish($user, $page, $content, $reply, $father): PageComment
    {
        return $this->pageCommentDb->publish($user, $page, $content, $reply, $father);
    }

    public function deleteComment($pageComment)
    {
        $this->pageCommentDb->deleteComment($pageComment);
    }
}