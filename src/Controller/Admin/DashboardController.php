<?php

namespace App\Controller\Admin;

use App\Entity\Apartment;
use App\Entity\ApartmentImage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    #[isGranted('ROLE_ADMIN')]
    public function index(): Response
    {
         return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Immo');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Menu', 'fa fa-home');
        yield MenuItem::section('Utilisateurs');
        yield MenuItem::subMenu('Actions utilisateurs', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Voir mes Utilisateurs', 'fas fa-eye', User::class),
            MenuItem::linkToCrud('Ajouter un utilisateur', 'fas fa-plus', User::class)->setAction(crud::PAGE_NEW)
        ]);
        yield MenuItem::subMenu('Actions sur les appartements', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Voir mes apartements', 'fas fa-eye', Apartment::class),
            MenuItem::linkToCrud('Ajouter un appartement', 'fas fa-plus', Apartment::class)->setAction(crud::PAGE_NEW),
        ]);
    }
}
