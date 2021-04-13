<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=BlogRepository::class)
 */
class Blog
{
    const CAT = [
        0 => 'Actualités presse',
        1 => 'Location',
        2 => 'Gestion',
        3 => 'Syndic',
        4 => 'Vente',
        5 => 'Immobilières',
        6 => 'Infos',
        7 => 'Immoblier neuf',
    ];

    const DRAFT = [
        0 => 'Brouillon',
        1 => 'En ligne',
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
    private $title;

    /**
     * @ORM\Column(type="string", length=135)
     */
    private $smallContent;

    /**
     * @ORM\Column(type="text")
     */
    private $largeContent;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $categorie;

    /**
     * @ORM\Column(type="integer")
     */
    private $roughDraft;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var PictureBlog|null
     */
    private $picture;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PictureBlog", mappedBy="blog", orphanRemoval=true, cascade={"persist"})
     */
    private $pictures;

    /**
     * @Assert\All({
     *   @Assert\Image(mimeTypes="image/jpeg")
     * })
     */
    private $pictureFiles;

    public function __construct()
     {
         $this->categorie = 0;
         $this->author = null;
         $this->createdAt = new \DateTime();
         $this->roughDraft = 0;
         $this->updated_at = new \DateTime();
         $this->pictures = new ArrayCollection();
     }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSmallContent(): ?string
    {
        return $this->smallContent;
    }

    public function setSmallContent(string $smallContent): self
    {
        $this->smallContent = $smallContent;

        return $this;
    }

    public function getLargeContent(): ?string
    {
        return $this->largeContent;
    }

    public function setLargeContent(string $largeContent): self
    {
        $this->largeContent = $largeContent;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

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

    public function getCategorie(): ?int
    {
        return $this->categorie;
    }

    public function setCategorie(int $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCatType(): string
    {
        return self::CAT[$this->categorie];
    }

    public function getRoughDraft(): ?int
    {
        return $this->roughDraft;
    }

    public function setRoughDraft(int $roughDraft): self
    {
        $this->roughDraft = $roughDraft;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|PictureBlog[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function getPicture(): ?PictureBlog
    {
        return $this->picture;
    }

    public function setPicture(PictureBlog $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function addPicture(PictureBlog $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setBlog($this);
        }

        return $this;
    }

    public function removePicture(PictureBlog $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getBlog() === $this) {
                $picture->setBlog(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    /**
     * @param mixed $pictureFiles
     * @return Blog
     */
    public function setPictureFiles($pictureFiles): self
    {
        foreach($pictureFiles as $pictureFile) {
            $picture = new PictureBlog();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;
        return $this;
    }

    public function getSlug(): string
    {
        return (new Slugify())->slugify($this->title);
    }

}
