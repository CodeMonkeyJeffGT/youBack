<?php
namespace App\Service;
use App\Entity\Menu;

class MenuService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}