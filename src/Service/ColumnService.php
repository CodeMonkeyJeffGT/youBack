<?php
namespace App\Service;
use App\Entity\Column;
use App\Entity\ColumnClassification;

class ColumnService
{
    private $entityManager;
    private $columnDb;
    private $columnClassificationDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->columnDb = $this->entityManager->getRepository(Column::class);
        $this->columnClassificationDb = $this->entityManager->getRepository(ColumnClassification::class);
    }

    public function list($query = '', $lastId = 0, $limit = 20)
    {
        if ($query !== '') {
            $arr = array();
            for ($i = 0, $len = mb_strlen($query); $i < $len; $i++)
            {
                $arr[] = mbsubstr($query, $i, 1);
            }
            $query = '%' . implode('%', $arr) . '%';
        }
        return $this->columnDb->listColumns($query, $lastId, $limit);;
    }
}