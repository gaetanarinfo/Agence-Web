<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Validator\Constraints as AppAssert;

class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=100)
     */
    private $lastname;

    /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=10)
     * @Assert\NotBlank()
     * @AppAssert\Telephone()
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $content;

    /**
     * @var Property|null
     */
    private $property;

    /**
     * @var Rent|null
     */
    private $rent;

    /**
     * @var AppartementA|null
     */
    private $appartementA;

     /**
     * @var AppartementB|null
     */
    private $appartementB;

    /**
     * Get the value of content
     *
     * @return  string|null
     */ 
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @param  string|null  $content
     *
     * @return  self
     */ 
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

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

    /**
     * Get the value of lastname
     *
     * @return  string|null
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @param  string|null  $lastname
     *
     * @return  self
     */ 
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of firstname
     *
     * @return  string|null
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @param  string|null  $firstname
     *
     * @return  self
     */ 
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of property
     *
     * @return  Property|null
     */ 
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set the value of property
     *
     * @param Property|null  $property
     *
     * @return self
     */ 
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get the value of rent
     *
     * @return Rent|null
     */ 
    public function getRent()
    {
        return $this->rent;
    }

    /**
     * Set the value of rent
     *
     * @param  Rent|null  $rent
     *
     * @return  self
     */ 
    public function setRent($rent)
    {
        $this->rent = $rent;

        return $this;
    }

        /**
     * Get the value of appartementA
     *
     * @return AppartementA|null
     */ 
    public function getAppartementA()
    {
        return $this->appartementA;
    }

    /**
     * Set the value of appartementA
     *
     * @param  AppartementA|null $appartementA
     *
     * @return  self
     */ 
    public function setAppartementA($appartementA)
    {
        $this->appartementA = $appartementA;

        return $this;
    }

    /**
     * Get the value of appartementB
     *
     * @return AppartementB|null
     */ 
    public function getAppartementB()
    {
        return $this->appartementB;
    }

    /**
     * Set the value of appartementB
     *
     * @param  AppartementB|null $appartementB
     *
     * @return  self
     */ 
    public function setAppartementB($appartementB)
    {
        $this->appartementB = $appartementB;

        return $this;
    }
}

?>