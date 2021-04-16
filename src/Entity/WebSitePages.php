<?php

namespace App\Entity;

use App\Repository\WebSitePagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebSitePagesRepository::class)
 */
class WebSitePages
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $smallContent;

    /**
     * @ORM\Column(type="text")
     */
    private $largeContent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSmallContent(): ?string
    {
        return $this->smallContent;
    }

    public function setSmallContent(string $smallContent): self
    {
        $this->smallContent = $smallContent;

        return $this;
    }

    public function getLargeContent(): ?string
    {
        return $this->largeContent;
    }

    public function setLargeContent(string $largeContent): self
    {
        $this->largeContent = $largeContent;

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
