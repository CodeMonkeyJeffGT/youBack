<?php
namespace App\Service;
use App\Entity\Page;

class PageService
{
    private $entityManager;
    private $pageDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->pageDb = $this->entityManager->getRepository(Page::class);
    }

    public function getNumber($column)
    {
        return $this->pageDb->getNumber($column);
    }
}