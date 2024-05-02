<?php

namespace App\Entity;

use App\Repository\CategoryImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: CategoryImageRepository::class)]
#[Vich\Uploadable]
class CategoryImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    //FALSE PROPERTY IN ORDER TO USE THE UPLOADS
    #[Vich\UploadableField(mapping: 'categories', fileNameProperty: 'nom', size: 'taille')]
    private ?File $file = null;
    // END OF FALSE PROPERTY

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $modification = null;

    #[ORM\ManyToOne(inversedBy: 'categoryImages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;

    //VICH FUNCTIONS GETTERS AND SETTERS
    public function getFile(): ?File
    {
        return $this->file;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;
        if(null !== $file) {
            $this->updatedAt = new \DateTimeImmutable();
    }
        return $this;
    }

    //END OF GETTERS AND SETTERS
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

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getModification(): ?\DateTimeImmutable
    {
        return $this->modification;
    }

    public function setModification(?\DateTimeImmutable $modification): static
    {
        $this->modification = $modification;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
