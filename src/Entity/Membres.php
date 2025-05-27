<?php

namespace App\Entity;

use App\Repository\MembresRepository;
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

    #[ORM\Column]
    private ?int $rank_id = null;

    #[ORM\Column]
    private ?\DateTime $joinDate = null;

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

    public function getRankId(): ?int
    {
        return $this->rank_id;
    }

    public function setRankId(int $rank_id): static
    {
        $this->rank_id = $rank_id;

        return $this;
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
}
