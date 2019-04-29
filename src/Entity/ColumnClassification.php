<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean")
     */
    private $removable;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Column", inversedBy="columnClassifications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $column_owned;

    public function __construct()
    {
        $this->columnClassifications = new ArrayCollection();
        $this->sons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getRemovable(): ?bool
    {
        return $this->removable;
    }

    public function setRemovable(bool $removable): self
    {
        $this->removable = $removable;

        return $this;
    }

    public function getColumnOwned(): ?column
    {
        return $this->column_owned;
    }

    public function setColumnOwned(?column $column_owned): self
    {
        $this->column_owned = $column_owned;

        return $this;
    }
}
