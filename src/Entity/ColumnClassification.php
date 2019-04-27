<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ColumnClassificationRepository")
 */
class ColumnClassification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $column_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $f_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $removable;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColumnId(): ?int
    {
        return $this->column_id;
    }

    public function setColumnId(int $column_id): self
    {
        $this->column_id = $column_id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFId(): ?int
    {
        return $this->f_id;
    }

    public function setFId(int $f_id): self
    {
        $this->f_id = $f_id;

        return $this;
    }

    public function getRemovable(): ?bool
    {
        return $this->removable;
    }

    public function setRemovable(bool $removable): self
    {
        $this->removable = $removable;

        return $this;
    }
}
