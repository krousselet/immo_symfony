<?php

namespace App\Services;

use App\Repository\ApartmentRepository;
use Psr\Log\LoggerInterface;

class AvailabilityService
{
    private ApartmentRepository $apartmentRepository;
    private LoggerInterface $logger;

    public function __construct(ApartmentRepository $apartmentRepository, LoggerInterface $logger)
    {
        $this->apartmentRepository = $apartmentRepository;
        $this->logger = $logger;
    }

    public function getAvailableDates(int $apartmentId): array
    {
        $this->logger->info('Fetching available dates for apartment ID: ' . $apartmentId);
        $availableDates = [];
        $apartment = $this->apartmentRepository->find($apartmentId);

        if (!$apartment) {
            $this->logger->error('Apartment not found with ID: ' . $apartmentId);
            throw new \Exception("Apartment not found");
        }

        $disponibilites = $apartment->getDisponibilites();

        foreach ($disponibilites as $disponibilite) {
            $availableDates[] = [
                'start' => $disponibilite->getDu()->format('Y-m-d\TH:i:sP'),
                'end' => $disponibilite->getAu()->format('Y-m-d\TH:i:sP'),
            ];
        }

        return $availableDates;
    }
}
