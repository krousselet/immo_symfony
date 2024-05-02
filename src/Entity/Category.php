<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, CategoryImage>
     */
    #[ORM\OneToMany(targetEntity: CategoryImage::class, mappedBy: 'category', cascade: ['persist'], orphanRemoval: true)]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, CategoryImage>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(CategoryImage $categoryImage): static
    {
        if (!$this->images->contains($categoryImage)) {
            $this->images->add($categoryImage);
            $categoryImage->setCategory($this);
        }

        return $this;
    }

    public function removeImage(CategoryImage $categoryImage): static
    {
        if ($this->images->removeElement($categoryImage)) {
            // set the owning side to null (unless already changed)
            if ($categoryImage->getCategory() === $this) {
                $categoryImage->setCategory(null);
            }
        }

        return $this;
    }
}
