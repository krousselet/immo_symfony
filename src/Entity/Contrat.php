<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContratRepository::class)]
class Contrat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "contrats")]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'contrats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Apartment $appartement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getAppartement(): ?Apartment
    {
        return $this->appartement;
    }

    public function setAppartement(?Apartment $appartement): static
    {
        $this->appartement = $appartement;

        return $this;
    }

    public function setId(null $null)
    {
        $this->id = null;

        return $this;
    }
}
