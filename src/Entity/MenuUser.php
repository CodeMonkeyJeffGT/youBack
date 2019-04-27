<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuUserRepository")
 */
class MenuUser
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
    private $menu_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $u_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $loc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenuId(): ?int
    {
        return $this->menu_id;
    }

    public function setMenuId(int $menu_id): self
    {
        $this->menu_id = $menu_id;

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

    public function getLoc(): ?int
    {
        return $this->loc;
    }

    public function setLoc(int $loc): self
    {
        $this->loc = $loc;

        return $this;
    }
}
