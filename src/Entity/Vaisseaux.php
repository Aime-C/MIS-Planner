<?php

namespace App\Entity;

use App\Repository\VaisseauxRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VaisseauxRepository::class)]
class Vaisseaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?\DateTime $realeaseDate = null;

    #[ORM\Column]
    private ?int $sizeCategory = null;

    #[ORM\Column]
    private ?int $marque = null;

    #[ORM\Column]
    private ?bool $isReleased = null;

    #[ORM\Column(nullable: true)]
    private ?float $height = null;

    #[ORM\Column(nullable: true)]
    private ?float $width = null;

    #[ORM\Column(nullable: true)]
    private ?float $length = null;

    public function getMarque(): ?int
    {
        return $this->marque;
    }

    public function setMarque(?int $marque): void
    {
        $this->marque = $marque;
    }

    #[ORM\Column]
    private ?int $SCU = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRealeaseDate(): ?\DateTime
    {
        return $this->realeaseDate;
    }

    public function setRealeaseDate(\DateTime $realeaseDate): static
    {
        $this->realeaseDate = $realeaseDate;

        return $this;
    }

    public function getSizeCategory(): ?int
    {
        return $this->sizeCategory;
    }

    public function setSizeCategory(int $sizeCategory): static
    {
        $this->sizeCategory = $sizeCategory;

        return $this;
    }

    public function isReleased(): ?bool
    {
        return $this->isReleased;
    }

    public function setIsReleased(bool $isReleased): static
    {
        $this->isReleased = $isReleased;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(?float $height): static
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth(): ?float
    {
        return $this->width;
    }

    public function setWidth(?float $width): static
    {
        $this->width = $width;

        return $this;
    }

    public function getLength(): ?float
    {
        return $this->length;
    }

    public function setLength(?float $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function getSCU(): ?int
    {
        return $this->SCU;
    }

    public function setSCU(int $SCU): static
    {
        $this->SCU = $SCU;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
