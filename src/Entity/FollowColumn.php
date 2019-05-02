<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FollowColumnRepository")
 */
class FollowColumn
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="followColumns")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Columns", inversedBy="followColumns")
     * @ORM\JoinColumn(nullable=false)
     */
    private $acolumn;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getAcolumn(): ?columns
    {
        return $this->acolumn;
    }

    public function setAcolumn(?columns $acolumn): self
    {
        $this->acolumn = $acolumn;

        return $this;
    }
}
