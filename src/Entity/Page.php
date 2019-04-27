<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
     * @ORM\Column(type="integer")
     */
    private $column_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $classificatoin_id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="integer")
     */
    private $u_id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;

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

    public function getColumnId(): ?int
    {
        return $this->column_id;
    }

    public function setColumnId(int $column_id): self
    {
        $this->column_id = $column_id;

        return $this;
    }

    public function getClassificatoinId(): ?int
    {
        return $this->classificatoin_id;
    }

    public function setClassificatoinId(int $classificatoin_id): self
    {
        $this->classificatoin_id = $classificatoin_id;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getUId(): ?int
    {
        return $this->u_id;
    }

    public function setUId(int $u_id): self
    {
        $this->u_id = $u_id;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }
}
