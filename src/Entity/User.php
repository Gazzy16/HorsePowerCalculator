<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="Email already taken")
 * @UniqueEntity(fields="username", message="Username already taken")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EngineStock", mappedBy="userstock")
     */
    private $stockengines;
    
    /**
     * One User has many stock engines.
     * @ORM\OneToMany(targetEntity="App\Entity\EngineTuned", mappedBy="usertuned")
     */
    private $tunedengines;

    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank()
     * Assert\Lenght(min = 6)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank()
     * Assert\Lenght(min = 6)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank()
     * Assert\Email()
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank()
     * Assert\Lenght(min = 6)
     */
    private $firstname;
    
    /**
     * @ORM\Column(type="string", length=255)
     * Assert\NotBlank()
     * Assert\Lenght(min = 6)
     */
    private $lastname;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     * Assert\NotBlank()
     * Assert\Lenght(min = 6)
     */
    private $isadmin;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isdeleted;
    
    public function __construct()
    {
        $this->stockengines = new ArrayCollection();
        $this->tunedengines = new ArrayCollection();
    }
    
    public function getStockEngines()
    {
        return $this->stockengines;
    }
    public function addStockEngine(?EngineStock $stockengine)
    {
        return $this->stockengines->add($stockengine);
    }
    public function removeStockEngine(?EngineStock $stockengine)
    {
        return $this->stockengines->remove($stockengine);
    }
    
    public function getTunedEngines()
    {
        return $this->tunedengines;
    }
    public function addTunedEngine(?EngineTuned $tunedengine)
    {
        return $this->tunedengines->add($tunedengine);
    }
    public function removeTunedEngine(?EngineTuned $tunedengine)
    {
        return $this->tunedengines->remove($tunedengine);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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

    public function getIsadmin(): ?string
    {
        return $this->isadmin;
    }

    public function setIsadmin(string $isadmin): self
    {
        $this->isadmin = $isadmin;

        return $this;
    }

    public function getIsdeleted(): ?string
    {
        return $this->isdeleted;
    }

    public function setIsdeleted(string $isdeleted): self
    {
        $this->isdeleted = $isdeleted;

        return $this;
    }
}
