<?php

namespace App\Entity;

use App\Repository\OptionAppartementARepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionAppartementARepository::class)
 * @ORM\Table(name="`optionappartementa`")
 */
class OptionAppartementA
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
     * @ORM\ManyToMany(targetEntity=App\Entity\AppartementA::class, mappedBy="options")
     */
    private $appartementA;

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
     * @return Collection|AppartementA[]
     */
    public function getAppartementA(): Collection
    {
        return $this->appartementA;
    }

    public function addAppartementA(AppartementA $appartementAs): self
    {
        if (!$this->appartementA->contains($appartementAs)) {
            $this->appartementA[] = $appartementAs;
        }

        return $this;
    }

    public function removeAppartementA(AppartementA $appartementA): self
    {
        $this->appartementA->removeElement($appartementA);

        return $this;
    }
}
