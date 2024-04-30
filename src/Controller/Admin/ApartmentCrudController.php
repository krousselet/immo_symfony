<?php

namespace App\Controller\Admin;

use App\Entity\Apartment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            // Correct configuration for file upload
            Field::new('imageFile', 'Apartment Image')
                ->setFormType(VichImageType::class)  // Important for upload functionality
                ->onlyOnForms(),  // Make sure it's only on forms

            // Additional field to show the image if needed

//            Field::new('imagePath', 'Image')
//            .setBasePath('/uploads/images')
//            .onlyOnDetail()
        ];
    }
}
