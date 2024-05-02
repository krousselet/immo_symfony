<?php

namespace App\Controller;

use App\Services\AvailabilityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalendarController extends AbstractController
{
    private $availabilityService;

    public function __construct(AvailabilityService $availabilityService)
    {
        $this->availabilityService = $availabilityService;
    }

    #[Route('/calendar', name: 'app_calendar')]
    public function index(): Response
    {
        $availabilities = $this->availabilityService->getAvailableDates();
//        dd($availabilities);

        return $this->render('calendar/index.html.twig', [
            'availabilities' => $availabilities,
        ]);
    }
}
