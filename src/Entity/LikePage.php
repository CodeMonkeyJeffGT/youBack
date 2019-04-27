<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikePageRepository")
 */
class LikePage
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
    private $p_id;

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

    public function getPId(): ?int
    {
        return $this->p_id;
    }

    public function setPId(int $p_id): self
    {
        $this->p_id = $p_id;

        return $this;
    }
}
