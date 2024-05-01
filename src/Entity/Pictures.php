<?php

namespace App\Entity;

use App\Repository\PicturesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Ignore;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PicturesRepository::class)]
#[Vich\Uploadable]
class Pictures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Apartment::class, inversedBy: 'pictureCollection')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Apartment $apartment = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "string", length: 255)]
    private ?string $legend = null;

    #[Vich\UploadableField(mapping: "apartment_images", fileNameProperty: "imageName")]
    #[Assert\Image]
    #[Ignore]
    private ?File $imageFile = null;

    #[ORM\Column(name: "image_files", type: "json")]
    private ?array $imageFiles = [];

    #[ORM\Column(type: "string", length: 255, nullable: true)]
    private ?string $imageName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getApartment(): ?Apartment
    {
        return $this->apartment;
    }

    public function setApartment(?Apartment $apartment): self
    {
        $this->apartment = $apartment;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLegend(): ?string
    {
        return $this->legend;
    }

    public function setLegend(?string $legend): self
    {
        $this->legend = $legend;
        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    public function getImageFiles(): ?array
    {
        return $this->imageFiles;
    }

    public function setImageFiles(?array $imageFiles): self
    {
        $this->imageFiles = $imageFiles;
        return $this;
    }

    public function addImageFile(File $imageFile): self
    {
        $imageName = $imageFile->getFilename();

        // Add the new image name to the array of image files
        if (!in_array($imageName, $this->imageFiles)) {
            $this->imageFiles[] = $imageName;
        }

        return $this;
    }

    public function removeImageFile(File $imageFile): self
    {
        $imageName = $imageFile->getFilename();

        // Find the index of the image name in the array of image files
        $index = array_search($imageName, $this->imageFiles);

        // If found, remove it from the array
        if ($index !== false) {
            unset($this->imageFiles[$index]);
        }

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;
        return $this;
    }
}
