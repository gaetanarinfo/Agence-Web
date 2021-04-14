<?php

namespace App\Entity;

use App\Repository\WebSiteFooterMenuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebSiteFooterMenuRepository::class)
 */
class WebSiteFooterMenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $button;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getButton(): ?string
    {
        return $this->button;
    }

    public function setButton(string $button): self
    {
        $this->button = $button;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
