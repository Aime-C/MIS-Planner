<?php

namespace App\Entity;

use App\Repository\VaisseauxMembresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VaisseauxMembresRepository::class)]
class VaisseauxMembres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $vaisseau_id = null;

    #[ORM\Column]
    private ?int $membre_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getVaisseauId(): ?int
    {
        return $this->vaisseau_id;
    }

    public function setVaisseauId(int $vaisseau_id): static
    {
        $this->vaisseau_id = $vaisseau_id;

        return $this;
    }

    public function getMembreId(): ?int
    {
        return $this->membre_id;
    }

    public function setMembreId(int $membre_id): static
    {
        $this->membre_id = $membre_id;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}
