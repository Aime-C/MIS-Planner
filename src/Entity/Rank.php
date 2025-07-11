<?php

namespace App\Entity;

use App\Repository\RankRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RankRepository::class)]
#[ORM\Table(name: '`rank`')]
class Rank
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    #[ORM\Column]
    private ?int $hierachie = null;


    /**
     * @var Collection<int, Membres>
     */
    #[ORM\OneToMany(targetEntity: Membres::class, mappedBy: 'rank')]
    private Collection $membres;

    public function __construct()
    {
        $this->membres = new ArrayCollection();
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

    public function getHierachie(): ?int
    {
        return $this->hierachie;
    }

    public function setHierachie(int $hierachie): static
    {
        $this->hierachie = $hierachie;

        return $this;
    }
}
