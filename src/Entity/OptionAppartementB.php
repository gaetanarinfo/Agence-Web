<?php

namespace App\Entity;

use App\Repository\OptionAppartementBRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OptionAppartementBRepository::class)
 * @ORM\Table(name="`optionappartementb`")
 */
class OptionAppartementB
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
     * @ORM\ManyToMany(targetEntity=App\Entity\AppartementB::class, mappedBy="options")
     */
    private $appartementB;

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
     * @return Collection|AppartementB[]
     */
    public function getAppartementB(): Collection
    {
        return $this->appartementB;
    }

    public function addAppartementB(AppartementB $appartementBs): self
    {
        if (!$this->appartementB->contains($appartementBs)) {
            $this->appartementB[] = $appartementBs;
        }

        return $this;
    }

    public function removeAppartementB(AppartementB $appartementB): self
    {
        $this->appartementB->removeElement($appartementB);

        return $this;
    }
}
