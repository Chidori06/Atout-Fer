<?php

namespace App\Form;

use App\Entity\Service;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du service',
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
            ->add('description', TextareaType::class, [
                'label' => 'Description du service',
                "required" => false,
            ])
            ->add('Ajouter', SubmitType::class, [
                "attr" => ["class" => "btn btn-green"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
