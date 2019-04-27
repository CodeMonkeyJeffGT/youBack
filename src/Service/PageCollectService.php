<?php
namespace App\Service;
use App\Entity\PageCollect;

class PageCollectService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}