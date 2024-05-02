<?php

namespace App\Entity;

use App\Repository\ApartmentRepository;
use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(?int $rooms): void
    {
        $this->rooms = $rooms;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(?int $surface): void
    {
        $this->surface = $surface;
    }

    public function getAvailableStart(): ?DateTimeInterface
    {
        return $this->availableStart;
    }

    public function setAvailableStart(?DateTimeInterface $availableStart): void
    {
        $this->availableStart = $availableStart;
    }

    public function getAvailableEnd(): ?DateTimeInterface
    {
        return $this->availableEnd;
    }

    public function setAvailableEnd(?DateTimeInterface $availableEnd): void
    {
        $this->availableEnd = $availableEnd;
    }

}
