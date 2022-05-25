<?php

namespace App\Form;

use App\Entity\Media;
use App\Entity\Trick;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameTrick', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('description')
            ->add('thumbnail', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
            ],
            ])
            ->add('userTrick')
            ->add('catTrick')
            ->add('trick', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image()
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
