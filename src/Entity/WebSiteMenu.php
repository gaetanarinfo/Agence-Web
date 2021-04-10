<?php

namespace App\Entity;

use App\Repository\WebSiteMenuRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WebSiteMenuRepository::class)
 */
class WebSiteMenu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of button
     */ 
    public function getButton()
    {
        return $this->button;
    }

    /**
     * Set the value of button
     *
     * @return  self
     */ 
    public function setButton($button)
    {
        $this->button = $button;

        return $this;
    }


    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
