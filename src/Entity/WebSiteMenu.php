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
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $button1;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $button2;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $button3;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $button4;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $button5;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $link1;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $link2;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $link3;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $link4;

    /**
     * @Assert\Length(max=20)
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $link5;

    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * Get the value of button1
     */ 
    public function getButton1()
    {
        return $this->button1;
    }

    /**
     * Set the value of button1
     *
     * @return  self
     */ 
    public function setButton1($button1)
    {
        $this->button1 = $button1;

        return $this;
    }

    /**
     * Get the value of button2
     */ 
    public function getButton2()
    {
        return $this->button2;
    }

    /**
     * Set the value of button2
     *
     * @return  self
     */ 
    public function setButton2($button2)
    {
        $this->button2 = $button2;

        return $this;
    }

    /**
     * Get the value of button3
     */ 
    public function getButton3()
    {
        return $this->button3;
    }

    /**
     * Set the value of button3
     *
     * @return  self
     */ 
    public function setButton3($button3)
    {
        $this->button3 = $button3;

        return $this;
    }

    /**
     * Get the value of button4
     */ 
    public function getButton4()
    {
        return $this->button4;
    }

    /**
     * Set the value of button4
     *
     * @return  self
     */ 
    public function setButton4($button4)
    {
        $this->button4 = $button4;

        return $this;
    }

    /**
     * Get the value of button5
     */ 
    public function getButton5()
    {
        return $this->button5;
    }

    /**
     * Set the value of button5
     *
     * @return  self
     */ 
    public function setButton5($button5)
    {
        $this->button5 = $button5;

        return $this;
    }

    public function getLink1(): ?string
    {
        return $this->link1;
    }

    public function setLink1(?string $link1): self
    {
        $this->link1 = $link1;

        return $this;
    }

    public function getLink2(): ?string
    {
        return $this->link2;
    }

    public function setLink2(?string $link2): self
    {
        $this->link2 = $link2;

        return $this;
    }

    public function getLink3(): ?string
    {
        return $this->link3;
    }

    public function setLink3(?string $link3): self
    {
        $this->link3 = $link3;

        return $this;
    }

    public function getLink4(): ?string
    {
        return $this->link4;
    }

    public function setLink4(?string $link4): self
    {
        $this->link4 = $link4;

        return $this;
    }

    public function getLink5(): ?string
    {
        return $this->link5;
    }

    public function setLink5(?string $link5): self
    {
        $this->link5 = $link5;

        return $this;
    }
}
