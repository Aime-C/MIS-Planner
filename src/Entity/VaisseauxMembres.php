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

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vaisseaux $vaisseau = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Membres $membre = null;


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

    public function getVaisseau(): ?Vaisseaux
    {
        return $this->vaisseau;
    }

    public function setVaisseau(?Vaisseaux $vaisseau): void
    {
        $this->vaisseau = $vaisseau;
    }

    public function getMembre(): ?Membres
    {
        return $this->membre;
    }

    public function setMembre(?Membres $membre): void
    {
        $this->membre = $membre;
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
