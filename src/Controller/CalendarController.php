<?php

namespace App\Controller;

use App\Entity\Apartment;
use App\Services\AvailabilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    private AvailabilityService $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;

    }

    #[Route('/calendar_', name: 'app_calendar')]
    public function index(EntityManagerInterface $em): Response
    {
        $apartments = $em->getRepository(Apartment::class)->findAll();

        return $this->render('calendar/index.html.twig', [
            'apartments' => $apartments
        ]);
    }

    #[Route('/api/availabilities/{apartmentId}', name: 'api_availabilities', methods: ['GET'])]

    public function getAvailabilities(int $apartmentId): JsonResponse
    {
        try {
            $availabilities = $this->availabilityService->getAvailableDates($apartmentId);
            return new JsonResponse($availabilities);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
