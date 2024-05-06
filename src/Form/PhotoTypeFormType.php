<?php

namespace App\Form;

use App\Entity\Photo;
use App\Entity\Piece;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoTypeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('piece', EntityType::class, [
                'class' => Piece::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
