<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MyspaceController extends AbstractController
{
    #[Route('/profile/myspace', name: 'app_myspace')]
    #[isGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('myspace/index.html.twig', [
            'controller_name' => 'MyspaceController',
        ]);
    }
}
