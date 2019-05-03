<?php
namespace App\Service;
use App\Entity\PageCollect;

class PageCollectService
{
    private $entityManager;
    private $pageCollectDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->pageCollectDb = $this->entityManager->getRepository(PageCollect::class);
    }

    public function getNumber($page): int
    {
        return $this->pageCollectDb->getNumber($page);
    }
}