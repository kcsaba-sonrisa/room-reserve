<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function __construct(
        #[ORM\Column(length: 255)]
        private string $name,

        #[ORM\Column]
        #[Assert\Range(min: -2, max: 10)]
        private int $bedNumber,

        #[ORM\Column]
        private bool $isReserved = false,

        #[ORM\Column(nullable: true)]
        private ?\DateTimeImmutable $updatedAt = null
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getBedNumber(): int
    {
        return $this->bedNumber;
    }

    public function isReserved(): bool
    {
        return $this->isReserved;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function update(string $name, int $bedNumber): void
    {
        $this->name = $name;
        $this->bedNumber = $bedNumber;
        $this->updatedAt = new \DateTimeImmutable();
    }
}
