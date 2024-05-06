<?php

namespace App\Controller\Admin;

use App\Entity\Piece;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;

class PieceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Piece::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ChoiceField::new('nom')
                ->setChoices([
                    'Salon bien 1' => 'Salon bien 1',
                    'Salon bien 2' => 'Salon bien 2',
                    'Salon bien 3' => 'Salon bien 3',
                    'Chambre bien 1' => 'Chambre bien 1',
                    'Chambre bien 2' => 'Chambre bien 2',
                    'Chambre bien 3' => 'Chambre bien 3',
                    'Salle de bain bien 1' => 'Salle de bain bien 1',
                    'Salle de bain bien 2' => 'Salle de bain bien 2',
                    'Salle de bain bien 3' => 'Salle de bain bien 3',
            ]),
            IntegerField::new('surface'),
            TextEditorField::new('description'),
            AssociationField::new('appartement')
                ->setCrudController(ApartmentCrudController::class)
                ->setFormTypeOptions([
                    'by_reference' => false
                ])
        ];
    }

}
