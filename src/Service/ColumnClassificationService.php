<?php
namespace App\Service;
use App\Entity\ColumnClassification;
use App\Entity\Page;

class ColumnClassificationService
{
    private $entityManager;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->columnClassificationDb = $this->entityManager->getRepository(ColumnClassification::class);
        $this->pageDb = $this->entityManager->getRepository(Page::class);
    }

    public function getClassifications($column)
    {
        return $this->columnClassificationDb->getClassifications($column);
    }

    public function updateInfo($column, $news)
    {
        $news = array_unique($news);
        $olds = $this->getClassifications($column);
        $del = array();
        foreach ($olds as $value) {
            if ($value->getRemovable() === false) {
                continue;
            }
            if ( ! in_array($value->getName(), $news)) {
                $del[] = $value;
            } else {
                $news = array_merge(array_diff($news, array($value->getName())));
            }
        }
        foreach ($del as $value) {
            $this->pageDb->changeClassToNullByClass($value);
        }
        $this->columnClassificationDb->insArr($column, $news);
        $this->columnClassificationDb->delArr($column, $del);
    }
}