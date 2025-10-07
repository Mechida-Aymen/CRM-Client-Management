<?php

namespace App\Entity;

use App\Enum\FactureStatusEnum;
use App\Repository\FactureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FactureRepository::class)]
class Facture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255,unique: true)]
    private ?string $factureNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotNull(message: "Facturation date is required.")]
    #[Assert\GreaterThan("today", message: "The facturation date must be in the future.")]
    private ?\DateTime $facturationDate = null;

    #[ORM\Column]
    #[Assert\NotNull(message: "Amount is required.")]
    #[Assert\GreaterThan(value: 0, message: "Amount must be greater than 0.")]
    private ?float $amount = null;

    #[ORM\Column(type: "string", length: 20)]
    private ?string $status = null;
    
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'factures')]
    private ?Client $owner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFactureNumber(): ?string
    {
        return $this->factureNumber;
    }

    public function setFactureNumber(string $factureNumber): static
    {
        $this->factureNumber = $factureNumber;

        return $this;
    }

    public function getFacturationDate(): ?\DateTime
    {
        return $this->facturationDate;
    }

    public function setFacturationDate(\DateTime $facturationDate): static
    {
        $this->facturationDate = $facturationDate;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): static
    {
        $this->amount = $amount;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        // Convert the FactureStatusEnum to a string (using its value)
        if ($status instanceof FactureStatusEnum) {
            $this->status = $status->value; // Use the enum value for storage in the database
        } else {
            $this->status = $status; // If it's a string, store it directly
        }
        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getOwner(): ?Client
    {
        return $this->owner;
    }

    public function setOwner(?Client $owner): static
    {
        $this->owner = $owner;

        return $this;
    }
}
