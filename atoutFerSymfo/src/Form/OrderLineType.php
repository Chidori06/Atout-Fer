<?php

namespace App\Form;

use App\Entity\CategoryService;
use App\Entity\Condition;
use App\Entity\Order;
use App\Entity\OrderLine;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderLineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('orders', EntityType::class, [
                'class' => Order::class,
                'choice_label' => 'id',
            ])
            ->add('catServLines', EntityType::class, [
                'class' => CategoryService::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
