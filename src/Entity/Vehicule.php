<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 64)]
    private ?string $brandt = null;

    #[ORM\Column(length: 64)]
    private ?string $model = null;

    #[ORM\Column(type: Types::ARRAY, nullable: true)]
    private ?array $features = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $year = null;

    #[ORM\Column]
    private ?float $kilometers = null;

    #[ORM\Column(length: 64)]
    private ?string $type = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getBrandt(): ?string
    {
        return $this->brandt;
    }

    public function setBrandt(string $brandt): static
    {
        $this->brandt = $brandt;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setFeatures(?array $features): static
    {
        $this->features = $features;

        return $this;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getKilometers(): ?float
    {
        return $this->kilometers;
    }

    public function setKilometers(float $kilometers): static
    {
        $this->kilometers = $kilometers;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }
}
