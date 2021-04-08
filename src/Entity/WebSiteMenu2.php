<?php

namespace App\Entity;

use App\Repository\WebSiteMenu2Repository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=WebSiteMenu2Repository::class)
 */
class WebSiteMenu2
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
    private $link1;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $link2;

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
}
