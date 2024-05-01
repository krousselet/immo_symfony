<?php

namespace App\Form;

use App\Entity\Apartment;
use App\Entity\Pictures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class PicturesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', CollectionType::class, [
                'entry_type' => VichFileType::class,
                'entry_options' => [
                    'required' => false,
                    'allow_delete' => true,
                    'download_uri' => false,
                    'label' => 'Image (upload new to replace existing)',
                ],
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])

            ->add('description')
            ->add('legend')
            ->add('imageName')
//            ->add('apartment', EntityType::class, [
//                'class' => Apartment::class,
//                'choice_label' => 'id',
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pictures::class,
        ]);
    }
}
