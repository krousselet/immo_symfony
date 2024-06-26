<?php

namespace App\Controller\Admin;

use App\Entity\Disponibilite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DisponibiliteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Disponibilite::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('du'),
            DateTimeField::new('au'),
            AssociationField::new('appartement')
                ->setCrudController(ApartmentCrudController::class)
                ->setFormTypeOptions([
                    'by_reference' => false
                ])
        ];
    }
}
