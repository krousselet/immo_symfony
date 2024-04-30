<?php

namespace App\Services;

use App\Repository\ApartmentRepository;

class AvailabilityService
{
    private $apartmentRepository;

    public function __construct(ApartmentRepository $apartmentRepository)
    {
        $this->apartmentRepository = $apartmentRepository;
    }


    public function getAvailableDates(): array
    {
        $availableDates = [];

        $availabilities = $this->apartmentRepository->findAvailabilities();

        foreach ($availabilities as $availability) {
            $availableDates[] = [
                'start' => $availability['availableStart']->format('Y-m-d'),
                'end' => $availability['availableEnd']->format('Y-m-d'),
            ];
        }

        return $availableDates;
    }
}