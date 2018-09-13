<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationLogRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ApplicationLog
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
    private $eventName;

    /**
     * @ORM\Column(type="text")
     */
    private $eventMessage;

    /**
     * @ORM\Column(type="datetime")
     */
    private $eventDatetime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $eventUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $eventCode;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eventPath;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $eventIP;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $eventMethod;

    public function getId()
    {
        return $this->id;
    }

    public function getEventName(): ?string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): self
    {
        $this->eventName = $eventName;

        return $this;
    }

    public function getEventMessage(): ?string
    {
        return $this->eventMessage;
    }

    public function setEventMessage(string $eventMessage): self
    {
        $this->eventMessage = $eventMessage;

        return $this;
    }

    public function getEventDatetime(): ?\DateTimeInterface
    {
        return $this->eventDatetime;
    }

    public function setEventDatetime(\DateTimeInterface $eventDatetime): self
    {
        $this->eventDatetime = $eventDatetime;

        return $this;
    }

    public function getEventUser(): ?int
    {
        return $this->eventUser;
    }

    public function setEventUser(?int $eventUser): self
    {
        $this->eventUser = $eventUser;

        return $this;
    }

    public function getEventCode(): ?int
    {
        return $this->eventCode;
    }

    public function setEventCode(int $eventCode): self
    {
        $this->eventCode = $eventCode;

        return $this;
    }

    public function getEventPath(): ?string
    {
        return $this->eventPath;
    }

    public function setEventPath(string $eventPath): self
    {
        $this->eventPath = $eventPath;

        return $this;
    }

    public function getEventIP(): ?string
    {
        return $this->eventIP;
    }

    public function setEventIP(string $eventIP): self
    {
        $this->eventIP = $eventIP;

        return $this;
    }

    public function getEventMethod(): ?string
    {
        return $this->eventMethod;
    }

    public function setEventMethod(string $eventMethod): self
    {
        $this->eventMethod = $eventMethod;

        return $this;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function setDefaultValues()
    {
        $this->eventDatetime = new \DateTime();
    }
}
