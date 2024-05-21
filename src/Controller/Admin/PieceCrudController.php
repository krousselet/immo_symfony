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
                    'Salon Studio' => 'Salon Studio',
                    'Salon T2' => 'Salon T2',
                    'Salon T3' => 'Salon T3',
                    'Chambre Studio' => 'Chambre Studio',
                    'Chambre T2' => 'Chambre T2',
                    'Chambre T3' => 'Chambre T3',
                    'Salle de bain Studio' => 'Salle de bain Studio',
                    'Salle de bain T2' => 'Salle de bain T2',
                    'Salle de bain T3' => 'Salle de bain T3',
                    'Cuisine Studio' => 'Cuisine Studio',
                    'Cuisine T2' => 'Cuisine T2',
                    'Cuisine T3' => 'Cuisine T3',
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
