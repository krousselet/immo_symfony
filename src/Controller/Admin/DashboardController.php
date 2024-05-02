<?php

namespace App\Controller\Admin;

use App\Entity\Apartment;
use App\Entity\Category;
use App\Entity\CategoryImage;
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
            ->setTitle('Immolavigny');
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
        yield MenuItem::subMenu('Actions sur les categories', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Voir mes categories', 'fas fa-eye', Category::class),
            MenuItem::linkToCrud('Ajouter une categorie', 'fas fa-plus', Category::class)->setAction(crud::PAGE_NEW),
        ]);
        yield MenuItem::subMenu('Actions sur les images', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Voir mes images', 'fas fa-eye', CategoryImage::class),
            MenuItem::linkToCrud('Ajouter une image', 'fas fa-image', CategoryImage::class)->setAction(crud::PAGE_NEW),
        ]);
    }
}
