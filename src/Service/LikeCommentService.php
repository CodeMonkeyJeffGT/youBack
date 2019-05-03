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

    public function getNumber($comment): int
    {
        return $this->likeCommentDb->getNumber($comment);
    }

    public function checkLike($user, $comment)
    {
        return ( ! empty($this->likeCommentDb->checkLike($user, $comment)));
    }

    public function like($user, $comment): bool
    {
        $likeComment = $this->likeCommentDb->checkLike($user, $comment);
        if ( ! empty($likeComment)) {
            return false;
        }
        $this->likeCommentDb->likeComment($user, $comment);
        return true;
    }

    public function unlike($user, $comment): bool
    {
        $likeComment = $this->likeCommentDb->checkLike($user, $comment);
        if (empty($likeComment)) {
            return false;
        }
        $this->likeCommentDb->unlikeComment($likeComment);
        return true;
    }
}