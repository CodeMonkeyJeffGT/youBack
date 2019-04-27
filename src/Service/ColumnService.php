<?php
namespace App\Service;
use App\Entity\Column;

class ColumnService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}