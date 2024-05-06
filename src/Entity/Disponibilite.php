<?php

namespace App\Entity;

use App\Repository\DisponibiliteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DisponibiliteRepository::class)]
class Disponibilite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Du = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $Au = null;

    #[ORM\ManyToOne(inversedBy: 'disponibilites')]
    private ?Apartment $appartement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDu(): ?\DateTimeImmutable
    {
        return $this->Du;
    }

    public function setDu(\DateTimeImmutable $Du): static
    {
        $this->Du = $Du;

        return $this;
    }

    public function getAu(): ?\DateTimeImmutable
    {
        return $this->Au;
    }

    public function setAu(\DateTimeImmutable $Au): static
    {
        $this->Au = $Au;

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
}
