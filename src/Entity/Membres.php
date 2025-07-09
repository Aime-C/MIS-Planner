<?php

namespace App\Entity;

use App\Repository\MembresRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MembresRepository::class)]
class Membres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'membres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Rank $rank = null;

    #[ORM\Column]
    private ?\DateTime $joinDate = null;

    #[ORM\Column(options: ["default" => 1])]
    private ?int $isActif = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): static
    {
        $this->pseudo = $pseudo;

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

    public function getRank(): ?Rank
    {
        return $this->rank;
    }

    public function setRank(?Rank $rank): void
    {
        $this->rank = $rank;
    }

    public function getJoinDate(): ?\DateTime
    {
        return $this->joinDate;
    }


    public function setJoinDate(\DateTime $joinDate): static
    {
        $this->joinDate = $joinDate;

        return $this;
    }

    public function getIsActif(): ?int
    {
        return $this->isActif;
    }

    public function setIsActif(?int $isActif): void
    {
        $this->isActif = $isActif;
    }

    /**
     * @return Collection<int, Membres>
     */
    public function getMembres(): Collection
    {
        return $this->membres;
    }

    public function addMembres(Membres $membres): static
    {
        if (!$this->membres->contains($membres)) {
            $this->membres->add($membres);
            $membres->setRankId($this);
        }

        return $this;
    }

    public function removeMembres(Membres $membres): static
    {
        if ($this->membres->removeElement($membres)) {
            // set the owning side to null (unless already changed)
            if ($membres->getRankId() === $this) {
                $membres->setRankId(null);
            }
        }

        return $this;
    }
}
