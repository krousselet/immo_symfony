<?php

namespace App\Controller;

use App\Entity\Apartment;
use App\Services\AvailabilityService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

class CalendarController extends AbstractController
{
    private $availabilityService;
    private $logger;

    public function __construct(AvailabilityService $availabilityService, LoggerInterface $logger)
    {
        $this->availabilityService = $availabilityService;
        $this->logger = $logger;
    }

    #[Route('/calendar', name: 'app_calendar')]
    public function index(EntityManagerInterface $em): Response
    {
        $apartments = $em->getRepository(Apartment::class)->findAll();

        return $this->render('calendar/index.html.twig', [
            'apartments' => $apartments
        ]);
    }

    #[Route('/calendar/{apartmentId}', name: 'app_calendar_id')]
    public function indexId(EntityManagerInterface $em, int $apartmentId): Response
    {
        $apartment = $em->getRepository(Apartment::class)->find($apartmentId);

        if (!$apartment) {
            throw new NotFoundHttpException('Apartment not found');
        }

        return $this->render('calendar/index-id.html.twig', [
            'apartment' => $apartment,
            'apartmentId' => $apartmentId
        ]);
    }

    #[Route('/api/availabilities/{apartmentId}', name: 'api_availabilities', methods: ['GET'])]
    public function getAvailabilities(int $apartmentId): JsonResponse
    {
        try {
            $this->logger->info('Fetching availabilities for apartment ID: ' . $apartmentId);
            $availabilities = $this->availabilityService->getAvailableDates($apartmentId);
            $this->logger->info('Availabilities: ' . json_encode($availabilities));
            return new JsonResponse($availabilities);
        } catch (\Exception $e) {
            $this->logger->error('Error fetching availabilities: ' . $e->getMessage());
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_NOT_FOUND);
        }
    }
}
