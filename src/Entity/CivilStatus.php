<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Utils\McString;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CivilStatusRepository")
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields="name", message="Ya existe un registro con ese nombre!")
 */
class CivilStatus
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min = 2, max = 75, minMessage = "Estado Civil debe tener al menos {{ limit }} caracteres de longitud", 
     *  maxMessage = "Estado Civil no puede ser mayor a {{ limit }} caracteres")
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    public function getId()
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        $this->createdAt = new \DateTime();
        $this->status = true;
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedDateValue() {
        $this->updatedAt = new \DateTime();
    }
    
    public function getNameSlug(): ?string 
    {
        return McString::slugify($this->name);
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }
    
}
