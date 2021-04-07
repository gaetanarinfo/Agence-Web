<?php

namespace App\Entity;

use App\Repository\WebSiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WebSiteRepository::class)
 */
class WebSiteHeader
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
    private $webTitle;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebTitle(): ?string
    {
        return $this->webTitle;
    }

    public function setWebTitle(string $webTitle): self
    {
        $this->webTitle = $webTitle;

        return $this;
    }
}
