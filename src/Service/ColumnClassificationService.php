<?php
namespace App\Service;
use App\Entity\ColumnClassification;

class ColumnClassificationService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}