<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikeCommentRepository")
 */
class LikeComment
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
    private $u_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $c_id;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getCId(): ?int
    {
        return $this->c_id;
    }

    public function setCId(int $c_id): self
    {
        $this->c_id = $c_id;

        return $this;
    }
}
