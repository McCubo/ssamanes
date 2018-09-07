<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements AdvancedUserInterface, \Serializable, EquatableInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $activatedAt;

    /**
     * @ORM\Column(type="smallint")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $role;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $expirationDate;

    public function getId()
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getActivatedAt(): ?\DateTimeInterface
    {
        return $this->activatedAt;
    }

    public function setActivatedAt(?\DateTimeInterface $activatedAt): self
    {
        $this->activatedAt = $activatedAt;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }
    
    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    } 

    public function getExpirationDate(): ?\DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(?\DateTimeInterface $expirationDate): self
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }
    
    # User interface abstract methods
    public function getSalt() {
        return null;
    }
    
    public function getRoles() {
        return array($this->role);
    }

    public function eraseCredentials() {
    }
    
    # AdvancedUserInterface abstract methods
    public function isAccountNonExpired() {
        if (is_null($this->expirationDate)) {
            return true;
        }
        if (new \DateTime() > $this->expirationDate) {
            return false;
        }
        return true;
    }

    public function isAccountNonLocked() {
        return $this->activatedAt != null;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->status == 1;
    }
    
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->username,
            $this->role,
            $this->password,
            $this->status,
            $this->expirationDate,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->username,
            $this->role,
            $this->password,
            $this->status,
            $this->expirationDate,
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
    
    public function isEqualTo(UserInterface $user)
    {
        if(!$user instanceof User) {
            return false;
        }
        return $this->isSameUser($user);
    }

    private function isSameUser(UserInterface $user): ?bool {
        if ($this->username != $user->getUsername()) {
            return false;
        }
        if ($this->password != $user->getPassword()) {
            return false;
        }
        if ($this->status != $user->getStatus()) {
            return false;
        }
        if ($this->role != $user->getRole()) {
            return false;
        }
        if ($this->expirationDate != $user->getExpirationDate() && new \DateTime() > $user->getExpirationDate()) {
            return false;
        }
        return true;
    }

}
