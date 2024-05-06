<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use App\Form\PhotoTypeFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('piece')
                ->setFormTypeOptions(['by_reference' => false]),

            // Display the image file itself using `ImageField`
            ImageField::new('imageName')
                ->setBasePath('/uploads/photos/piece')
                ->setUploadDir('/public/uploads/photos/piece')
                ->setLabel('Image'),

            AssociationField::new('piece')
                ->setCrudController(PieceCrudController::class)
                ->setFormTypeOptions([
                    'by_reference' => false,
                ]),
        ];
    }
}
