<?php

namespace App\Entity;

use App\Repository\VerificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VerificationRepository::class)
 */
class Verification
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $code;

    /**
     * @ORM\Column(type="datetime")
     */
    private $generatedAt;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $phoneNumber;

    /**
     * @ORM\Column(type="boolean")
     */
    private $used;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getGeneratedAt(): ?\DateTimeInterface
    {
        return $this->generatedAt;
    }

    public function setGeneratedAt(\DateTimeInterface $generatedAt): self
    {
        $this->generatedAt = $generatedAt;

        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    public function setUsed(bool $used): self
    {
        $this->used = $used;

        return $this;
    }

    public function getUsed(): ?bool
    {
        return $this->used;
    }
}
