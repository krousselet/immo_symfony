<?php

namespace App\Controller;

use App\Entity\Apartment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
class CalendarIdController extends AbstractController
{

    #[Route('/calendar_{apartmentId}', name: 'app_calendar_id')]
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
}
