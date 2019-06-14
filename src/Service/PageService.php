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

    public function getNumber($column): int
    {
        return $this->pageDb->getNumber($column);
    }

    public function getPage($id): ?Page
    {
        $page = $this->pageDb->find($id);
        return $page;
    }

    public function userPages($user, $lastId, $limit): array
    {
        $pages = $this->pagesDb->listUserPages($user, $lastId, $limit);
        return $pages;
    }

    public function list($column, $class, $query, $lastId, $limit): array
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
        $pages = $this->pageDb->listPages($column, $class, $query, $lastId, $limit);
        return $pages;
    }

    public function publish($user, $column, $columnClass, $name, $content): Page
    {
        return $this->pageDb->publish($user, $column, $columnClass, $name, $content);
    }

    public function delete($page)
    {
        $this->pageDb->deletePage($page);
    }
}