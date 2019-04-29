<?php
namespace App\Service;
use App\Entity\School;

class SchoolService
{
    private $entityManager;
    private $schoolDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->schoolDb = $this->entityManager->getRepository(School::class);
    }

    public function list()
    {
        $schools = $this->schoolDb->list();
        return $schools;
    }

    public function getSchool($id)
    {
        $school = $this->schoolDb->getSchool($id);
        return $school;
    }
}