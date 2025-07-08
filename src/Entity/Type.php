<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, Vaisseaux>
     */
    #[ORM\OneToMany(targetEntity: Vaisseaux::class, mappedBy: 'type')]
    private Collection $vaisseaux;

    public function __construct()
    {
        $this->vaisseaux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getVaisseaux(): Collection
    {
        return $this->vaisseaux;
    }

    public function setVaisseaux(Collection $vaisseaux): void
    {
        $this->vaisseaux = $vaisseaux;
    }
}
