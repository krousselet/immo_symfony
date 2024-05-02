<?php

namespace App\Controller\Admin;

use App\Entity\Apartment;
use App\Form\PicturesType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ApartmentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Apartment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            IntegerField::new('rooms'),
            IntegerField::new('surface'),
            DateTimeField::new('availableStart'),
            DateTimeField::new('availableEnd'),
            AssociationField::new('categories', 'Categories')
                ->setCrudController(CategoryCrudController::class) // Correctly link to CategoryCrudController
                ->setFormTypeOptions([
                    'by_reference' => false,
                ])
                ->onlyOnForms(),
        ];
    }
}
