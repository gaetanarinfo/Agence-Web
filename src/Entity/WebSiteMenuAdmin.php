<?php

namespace App\Entity;

use App\Repository\WebSiteMenuAdminRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WebSiteMenuAdminRepository::class)
 */
class WebSiteMenuAdmin
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

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon;

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

    /**
     * Get the value of link
     */ 
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set the value of link
     *
     * @return  self
     */ 
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get the value of icon
     */ 
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set the value of icon
     *
     * @return  self
     */ 
    public function setIcon($icon)
    {
        $this->icon1 = $icon;

        return $this;
    }

}
