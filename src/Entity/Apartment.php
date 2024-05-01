<?php

namespace App\Entity;

use App\Repository\ApartmentRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ApartmentRepository::class)]
class Apartment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $rooms = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $availableStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?DateTimeInterface $availableEnd = null;

    /**
     * @var Collection<int, Pictures>
     */
    #[ORM\OneToMany(targetEntity: Pictures::class, mappedBy: 'apartment', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $pictureCollection;

    // ADDED FOR VICH ///////////////////
//    #[ORM\ManyToOne(inversedBy: 'pictureCollection')]
//    #[ORM\JoinColumn(nullable: false)]
//    private ?Apartment $pictures = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    //END OF ADDING //////////////////////////////
    public function __construct()
    {
        $this->pictureCollection = new ArrayCollection();
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): static
    {
        $this->rooms = $rooms;

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

    public function getAvailableStart(): ?DateTimeInterface
    {
        return $this->availableStart;
    }

    public function setAvailableStart(DateTimeInterface $availableStart): static
    {
        $this->availableStart = $availableStart;

        return $this;
    }

    public function getAvailableEnd(): ?DateTimeInterface
    {
        return $this->availableEnd;
    }

    public function setAvailableEnd(DateTimeInterface $availableEnd): static
    {
        $this->availableEnd = $availableEnd;

        return $this;
    }

    /**
     * @return Collection<int, Pictures>
     */
    public function getPictureCollection(): Collection
    {
        return $this->pictureCollection;
    }

    public function addPictureCollection(Pictures $picture): self
    {
        if (!$this->pictureCollection->contains($picture)) {
            $this->pictureCollection[] = $picture;
            $picture->setApartment($this);
        }
        return $this;
    }

    public function removePictureCollection(Pictures $picture): self
    {
        if ($this->pictureCollection->removeElement($picture)) {
            if ($picture->getApartment() === $this) {
                $picture->setApartment(null);
            }
        }
        return $this;
    }

}
