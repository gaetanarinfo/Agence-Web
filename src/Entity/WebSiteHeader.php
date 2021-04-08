<?php

namespace App\Entity;

use App\Repository\WebSiteHeaderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WebSiteHeaderRepository::class)
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
     * @Assert\Length(max=50)
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $webTitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }
}
