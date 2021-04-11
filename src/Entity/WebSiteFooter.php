<?php

namespace App\Entity;

use App\Repository\WebSiteFooterRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as AppAssert;

/**
 * @ORM\Entity(repositoryClass=WebSiteFooterRepository::class)
 */
class WebSiteFooter
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
    private $facebook;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $twitter;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $instagram;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $linkedin;

    /**
     * @Assert\Length(max=100)
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=10)
     * @Assert\NotBlank()
     * @AppAssert\Telephone()
     */
    private $phone;

    /**
     * @Assert\Length(max=100)
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @Assert\Length(max=7)
     * @ORM\Column(type="integer", length=7, nullable=true)
     */
    private $postalCode;

    /**
     * @Assert\Length(max=40)
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $copyright;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getTwitter(): ?string
    {
        return $this->twitter;
    }

    public function setTwitter(?string $twitter): self
    {
        $this->twitter = $twitter;

        return $this;
    }

    public function getInstagram(): ?string
    {
        return $this->instagram;
    }

    public function setInstagram(?string $instagram): self
    {
        $this->instagram = $instagram;

        return $this;
    }

    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }

    public function setLinkedin(?string $linkedin): self
    {
        $this->linkedin = $linkedin;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     * @param string $phone
    */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPostalCode(): ?int
    {
        return $this->postalCode;
    }

    public function setPostalCode(?int $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCopyright(): ?string
    {
        return $this->copyright;
    }

    public function setCopyright(string $copyright): self
    {
        $this->copyright = $copyright;

        return $this;
    }

}
