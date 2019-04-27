<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FollowUserRepository")
 */
class FollowUser
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
    private $f_id;

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

    public function getFId(): ?int
    {
        return $this->f_id;
    }

    public function setFId(int $f_id): self
    {
        $this->f_id = $f_id;

        return $this;
    }
}
