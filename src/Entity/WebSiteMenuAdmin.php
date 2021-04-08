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
    private $button1;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button2;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link1;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link2;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button3;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link3;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button4;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link4;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button5;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button6;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $button7;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link5;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link6;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $link7;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon1;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon2;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon3;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon4;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon5;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon6;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $icon7;

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
     * Get the value of link2
     */ 
    public function getLink2()
    {
        return $this->link2;
    }

    /**
     * Set the value of link2
     *
     * @return  self
     */ 
    public function setLink2($link2)
    {
        $this->link2 = $link2;

        return $this;
    }

    /**
     * Get the value of link1
     */ 
    public function getLink1()
    {
        return $this->link1;
    }

    /**
     * Set the value of link1
     *
     * @return  self
     */ 
    public function setLink1($link1)
    {
        $this->link1 = $link1;

        return $this;
    }

    public function getButton3(): ?string
    {
        return $this->button3;
    }

    public function setButton3(string $button3): self
    {
        $this->button3 = $button3;

        return $this;
    }

    public function getLink3(): ?string
    {
        return $this->link3;
    }

    public function setLink3(string $link3): self
    {
        $this->link3 = $link3;

        return $this;
    }

    public function getButton4(): ?string
    {
        return $this->button4;
    }

    public function setButton4(?string $button4): self
    {
        $this->button4 = $button4;

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

    public function getButton5(): ?string
    {
        return $this->button5;
    }

    public function setButton5(?string $button5): self
    {
        $this->button5 = $button5;

        return $this;
    }

    public function getButton6(): ?string
    {
        return $this->button6;
    }

    public function setButton6(?string $button6): self
    {
        $this->button6 = $button6;

        return $this;
    }

    public function getButton7(): ?string
    {
        return $this->button7;
    }

    public function setButton7(string $button7): self
    {
        $this->button7 = $button7;

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

    public function getLink6(): ?string
    {
        return $this->link6;
    }

    public function setLink6(?string $link6): self
    {
        $this->link6 = $link6;

        return $this;
    }

    public function getLink7(): ?string
    {
        return $this->link7;
    }

    public function setLink7(?string $link7): self
    {
        $this->link7 = $link7;

        return $this;
    }


    /**
     * Get the value of icon1
     */ 
    public function getIcon1()
    {
        return $this->icon1;
    }

    /**
     * Set the value of icon1
     *
     * @return  self
     */ 
    public function setIcon1($icon1)
    {
        $this->icon1 = $icon1;

        return $this;
    }

    /**
     * Get the value of icon2
     */ 
    public function getIcon2()
    {
        return $this->icon2;
    }

    /**
     * Set the value of icon2
     *
     * @return  self
     */ 
    public function setIcon2($icon2)
    {
        $this->icon2 = $icon2;

        return $this;
    }

    /**
     * Get the value of icon3
     */ 
    public function getIcon3()
    {
        return $this->icon3;
    }

    /**
     * Set the value of icon3
     *
     * @return  self
     */ 
    public function setIcon3($icon3)
    {
        $this->icon3 = $icon3;

        return $this;
    }

    /**
     * Get the value of icon4
     */ 
    public function getIcon4()
    {
        return $this->icon4;
    }

    /**
     * Set the value of icon4
     *
     * @return  self
     */ 
    public function setIcon4($icon4)
    {
        $this->icon4 = $icon4;

        return $this;
    }

    /**
     * Get the value of icon5
     */ 
    public function getIcon5()
    {
        return $this->icon5;
    }

    /**
     * Set the value of icon5
     *
     * @return  self
     */ 
    public function setIcon5($icon5)
    {
        $this->icon5 = $icon5;

        return $this;
    }

    /**
     * Get the value of icon6
     */ 
    public function getIcon6()
    {
        return $this->icon6;
    }

    /**
     * Set the value of icon6
     *
     * @return  self
     */ 
    public function setIcon6($icon6)
    {
        $this->icon6 = $icon6;

        return $this;
    }

    /**
     * Get the value of icon7
     */ 
    public function getIcon7()
    {
        return $this->icon7;
    }

    /**
     * Set the value of icon7
     *
     * @return  self
     */ 
    public function setIcon7($icon7)
    {
        $this->icon7 = $icon7;

        return $this;
    }
}
