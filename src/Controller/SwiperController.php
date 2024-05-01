<?php

namespace App\Controller;

use App\Entity\Pictures;
use App\Repository\ApartmentImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SwiperController extends AbstractController
{
    #[Route('/swiper', name: 'app_swiper')]
    public function index(EntityManagerInterface $em): Response
    {
        $pictures = $em->getRepository(Pictures::class)->findAll();
        return $this->render('swiper/index.html.twig', [
            'pictures' => $pictures,
        ]);
    }
}
