<?php

namespace App\Entity;

use App\Repository\MailboxRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MailboxRepository::class)
 */
class Mailbox
{

    const CAT = [
        0 => 'Bien',
        1 => 'Location',
        2 => 'Gérance',
        3 => 'Transaction'
    ];

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isRead;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $createdAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $favorite;

    /**
     * @ORM\Column(type="boolean")
     */
    private $important;

    /**
     * @ORM\Column(type="boolean")
     */
    private $trash;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $phone;

    public function __construct()
     {
         $this->isRead = 0;
         $this->favorite = 0;
         $this->important = 0;
         $this->trash = 0;
         $this->categorie = 0;
         $this->createdAt = new \DateTime();
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getIsRead(): ?bool
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead): self
    {
        $this->isRead = $isRead;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getFavorite(): ?bool
    {
        return $this->favorite;
    }

    public function setFavorite(bool $favorite): self
    {
        $this->favorite = $favorite;

        return $this;
    }

    public function getImportant(): ?bool
    {
        return $this->important;
    }

    public function setImportant(bool $important): self
    {
        $this->important = $important;

        return $this;
    }

    public function getTrash(): ?bool
    {
        return $this->trash;
    }

    public function setTrash(bool $trash): self
    {
        $this->trash = $trash;

        return $this;
    }

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(?int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
