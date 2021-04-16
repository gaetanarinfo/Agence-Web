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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $background;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $websiteUrl;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $GoogleAnalystics;

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

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getWebsiteUrl(): ?string
    {
        return $this->websiteUrl;
    }

    public function setWebsiteUrl(string $websiteUrl): self
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    public function getGoogleAnalystics(): ?string
    {
        return $this->GoogleAnalystics;
    }

    public function setGoogleAnalystics(?string $GoogleAnalystics): self
    {
        $this->GoogleAnalystics = $GoogleAnalystics;

        return $this;
    }
}
