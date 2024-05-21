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
    private ?\DateTimeImmutable $du = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $au = null;

    #[ORM\ManyToOne(inversedBy: 'disponibilites')]
    private ?Apartment $appartement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDu(): ?\DateTimeImmutable
    {
        return $this->du;
    }

    public function setDu(\DateTimeImmutable $du): static
    {
        $this->du = $du;

        return $this;
    }

    public function getAu(): ?\DateTimeImmutable
    {
        return $this->au;
    }

    public function setAu(\DateTimeImmutable $au): static
    {
        $this->au = $au;

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
