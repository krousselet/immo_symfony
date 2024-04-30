<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SwiperController extends AbstractController
{
    #[Route('/swiper', name: 'app_swiper')]
    public function index(): Response
    {
        return $this->render('swiper/index.html.twig', [
            'controller_name' => 'SwiperController',
        ]);
    }
}
