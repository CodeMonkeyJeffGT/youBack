<?php
namespace App\Service;
use App\Entity\CollectPage;

class CollectPageService
{
    private $entityManager;
    private $collectPageDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->collectPageDb = $this->entityManager->getRepository(CollectPage::class);
    }

    public function getNumber($page): int
    {
        return $this->collectPageDb->getNumber($page);
    }

    public function list($user): array
    {
        return $this->collectPageDb->list($user);
    }

    public function checkCollect($user, $page)
    {
        return ( ! empty($this->collectPageDb->checkCollect($user, $page)));
    }

    public function collect($user, $page): bool
    {
        $collectPage = $this->collectPageDb->checkCollect($user, $page);
        if ( ! empty($collectPage)) {
            return false;
        }
        $this->collectPageDb->collectPage($user, $page);
        return true;
    }

    public function uncollect($user, $page): bool
    {
        $collectPage = $this->collectPageDb->checkCollect($user, $page);
        if (empty($collectPage)) {
            return false;
        }
        $this->collectPageDb->uncollectPage($collectPage);
        return true;
    }
}