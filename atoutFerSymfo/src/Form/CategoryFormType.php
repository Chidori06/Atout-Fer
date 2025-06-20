<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class CategoryFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la catégorie',
                'required' => false
            ])
            ->add('image', FileType::class, [
                "label" => "Image",
                "mapped" => false,
                "required" => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/svg+xml',
                            'image/webp'
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image (jpg/png/webp)',
                        'maxSizeMessage' => 'Ce fichier est trop volumineux'
                    ])
                ]

            ])
            ->add('parent', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie Parente',
                'choice_label' => 'name',
                'required' => false
            ])
            ->add('Ajouter', SubmitType::class, [
                "attr" => ["class" => "btn btn-green"]
            ])
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
