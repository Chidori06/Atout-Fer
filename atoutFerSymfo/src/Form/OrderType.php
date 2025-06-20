<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Status;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('statusOrder', EntityType::class, [
                'class' => Status::class,
                'label' => 'Statut de la commande',
                'choice_label' => 'name',
            ])
            ->add('Modifier', SubmitType::class, [
                "attr" => ["class" => "btn btn-green"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
