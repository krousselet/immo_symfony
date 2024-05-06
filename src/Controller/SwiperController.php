<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SwiperController extends AbstractController
{
    #[Route('/swiper', name: 'app_swiper')]
    public function index(EntityManagerInterface $em): Response
    {
        // Fetch apartments and eagerly load related rooms and photos
        $query = $em->createQuery(
            'SELECT a, p, ph
        FROM App\Entity\Apartment a
        JOIN a.pieces p
        JOIN p.photos ph'
        );
        $apartments = $query->getResult();

        return $this->render('swiper/index.html.twig', [
            'apartments' => $apartments
        ]);
    }
}
