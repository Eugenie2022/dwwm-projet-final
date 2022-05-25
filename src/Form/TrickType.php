<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Media;
use App\Entity\Trick;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use function Sodium\add;

class TrickType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameTrick', TextType::class, [
                'label' => 'Nom de la figure'
            ])
            ->add('description')
            ->add('thumbnail',
                FileType::class, [
                        'label' => 'Image Principale',
                        'mapped' => false,
                        'required' => false,
                        'constraints' => [
                            new Image()
                        ],

            ])

            ->add('catTrick', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie'
            ])

            ->add('medias', CollectionType::class, [
                'entry_type' => MediaType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])

//            ->add('path', FileType::class, [
//                'label' => 'Image Principale',
//                'mapped' => false,
//                'required' => false,
//                'constraints' => [
//                    new Image()
//                ],
//            ])



            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trick::class,
        ]);
    }
}
