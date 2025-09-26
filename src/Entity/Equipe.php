<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipeRepository::class)]
class Equipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Membres>
     */
    #[ORM\ManyToMany(targetEntity: Membres::class, inversedBy: 'equipes')]
    private Collection $membres;

    #[ORM\ManyToOne(inversedBy: 'equipes')]
    private ?TypeEquipe $typeEquipe = null;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Membres>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembre(Membres $membre): static
    {
        if (!$this->membres->contains($membre)) {
            $this->membres->add($membre);
        }

        return $this;
    }

    public function removeMembre(Membres $membre): static
    {
        $this->membres->removeElement($membre);

        return $this;
    }

    public function getTypeEquipe(): ?TypeEquipe
    {
        return $this->typeEquipe;
    }

    public function setTypeEquipe(?TypeEquipe $typeEquipe): static
    {
        $this->typeEquipe = $typeEquipe;

        return $this;
    }
}
