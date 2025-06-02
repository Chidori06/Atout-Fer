<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\CategoryService;
use App\Entity\Service;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class, [
                'currency' => 'EUR',
                'label' => 'Prix',
                'required' => false
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
            ])
            ->add('services', EntityType::class, [
                'class' => Service::class,
                'choice_label' => 'name',
                'label' => 'Service',
            ])
            ->add('Ajouter', SubmitType::class, [
                "attr" => ["class" => "btn btn-green"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoryService::class,
        ]);
    }
}
