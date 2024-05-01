<?php

namespace App\Controller\Admin;

use App\Entity\Apartment;
use App\Form\PicturesType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
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
        $imageFields = CollectionField::new('pictureCollection', 'Images')
            ->setEntryType(PicturesType::class)
            ->setFormTypeOptions([
                'by_reference' => false,  // Ensures that Symfony manages the collection correctly
                'allow_add' => true,      // Allows users to add new images dynamically
                'allow_delete' => true,   // Allows users to delete images
            ])
            ->onlyOnForms();
        return [
            TextField::new('title'),
            IntegerField::new('rooms'),
            IntegerField::new('surface'),
            DateTimeField::new('availableStart'),
            DateTimeField::new('availableEnd'),
            $imageFields,

        ];
    }
}
