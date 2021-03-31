<?php

namespace App\Entity;

use App\Repository\OptionRentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionRentRepository::class)
 * @ORM\Table(name="`optionrent`")
 */
class OptionRent
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
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=App\Entity\Rent::class, mappedBy="options")
     */
    private $rent;

    public function __construct()
    {
        $this->rent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Rent[]
     */
    public function getRent(): Collection
    {
        return $this->rent;
    }

    public function addRent(Rent $rents): self
    {
        if (!$this->rent->contains($rents)) {
            $this->rent[] = $rents;
        }

        return $this;
    }

    public function removeRent(Rent $rents): self
    {
        $this->rent->removeElement($rents);

        return $this;
    }
}
