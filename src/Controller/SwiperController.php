<?php

namespace App\Controller;

use App\Entity\Apartment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class SwiperController extends AbstractController
{
    #[Route('/swiper', name: 'app_swiper')]
    public function index(EntityManagerInterface $em): Response
    {
        $apartments = $em->getRepository(Apartment::class)->findAll();

        return $this->render('swiper/index.html.twig', [
            'apartments' => $apartments
        ]);
    }

    #[Route('/{uniqueId}', name: 'app_swiper_id')]
    public function indexId(EntityManagerInterface $em, string $uniqueId): Response
    {
        // Fetch the apartment based on the uniqueId
        $query = $em->createQuery(
            'SELECT a, p, ph
        FROM App\Entity\Apartment a
        JOIN a.pieces p
        JOIN p.photos ph
        WHERE a.uniqueId = :uniqueId'
        );
        $query->setParameter('uniqueId', $uniqueId);
        $apartment = $query->getSingleResult();

        // Check if the apartment exists
        if (!$apartment) {
            throw new NotFoundHttpException('Appartement non trouvé');
        }

        return $this->render('swiper/index-id.html.twig', [
            'apartment' => $apartment
        ]);
    }
}
