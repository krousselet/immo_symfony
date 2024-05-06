<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(cascade: ['persist', 'remove'], inversedBy: 'pieces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Apartment $appartement = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    /**
     * @var Collection<int, Photo>
     */
    #[ORM\OneToMany(targetEntity: Photo::class, mappedBy: 'piece', cascade: ['persist', 'remove'])]
    private Collection $photos;

    public function __construct()
    {
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): static
    {
        $this->surface = $surface;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Photo>
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
            $photo->setPiece($this);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        if ($this->photos->removeElement($photo)) {
            // set the owning side to null (unless already changed)
            if ($photo->getPiece() === $this) {
                $photo->setPiece(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
