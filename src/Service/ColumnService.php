<?php
namespace App\Service;
use App\Entity\Columns;
use App\Entity\ColumnClassification;
use App\Entity\FollowColumn;

class ColumnService
{
    private $entityManager;
    private $columnDb;
    private $columnClassificationDb;
    private $followColumnDb;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->columnDb = $this->entityManager->getRepository(Columns::class);
        $this->columnClassificationDb = $this->entityManager->getRepository(ColumnClassification::class);
        $this->followColumnDb = $this->entityManager->getRepository(FollowColumn::class);
    }
    
    public function getColumn($id): ?Columns
    {
        $column = $this->columnDb->find($id);
        return $column;
    }

    public function list($query = '', $lastId = 0, $limit = 20): array
    {
        if ($query !== '') {
            $arr = array();
            for ($i = 0, $len = mb_strlen($query); $i < $len; $i++)
            {
                $arr[] = mb_substr($query, $i, 1);
            }
            $query = '%' . implode('%', $arr) . '%';
        }
        if ($query === '') {
            $query = '%';
        }
        $columns = $this->columnDb->listColumns($query, $lastId, $limit);
        return $columns;
    }

    public function apply($user, $name, $description)
    {
        if ( ! is_null($this->columnDb->searchByName($name))) {
            return false;
        }
        return $this->columnDb->apply($user, $name, $description);
    }

    public function updateInfo($column, $description): Columns
    {
        return $this->columnDb->updateInfo($column, $description);
    }
}