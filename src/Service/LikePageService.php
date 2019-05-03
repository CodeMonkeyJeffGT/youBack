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

    public function checkLike($user, $page)
    {
        return ( ! empty($this->likePageDb->checkLike($user, $page)));
    }

    public function like($user, $page): bool
    {
        $likePage = $this->likePageDb->checkLike($user, $page);
        if ( ! empty($likePage)) {
            return false;
        }
        $this->likePageDb->likePage($user, $page);
        return true;
    }

    public function unlike($user, $page): bool
    {
        $likePage = $this->likePageDb->checkLike($user, $page);
        if (empty($likePage)) {
            return false;
        }
        $this->likePageDb->unlikePage($likePage);
        return true;
    }
}