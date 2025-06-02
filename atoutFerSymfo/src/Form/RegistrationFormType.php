<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail',
                'required' => false
            ])
            ->add('lastname', TextType::class, [
                "label" => "Nom",
                "required" => false
            ])
            ->add('firstname', TextType::class, [
                "label" => "Prénom",
                "required" => false,

            ])
            ->add('gender', choiceType::class, [
                "label" => "Genre",
                'choices' => [
                    'Homme' => 'Homme',
                    'Femme' => 'Femme',
                    'Ne se prononce pas' => null,
                ],
                'multiple' => false,
                'expanded' => true,
            ])
            ->add('birthdate', DateType::class, [
                "label" => "Date de naissance",
                'required' => false,
                'years' => range(1900, 2024),
                'format' => 'dd-MM-yyyy',
                'placeholder' => [
                    'day' => 'Jour',
                    'month' => 'Mois',
                    'year' => 'Année',
                ],
            ])

            ->add('roles', CollectionType::class, [
                'label' => 'Rôles',
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'label' => false,
                    'choices' => [
                        'Administrateur' => 'ROLE_ADMIN',
                        'Utilisateur' => 'ROLE_USER',
                        'Employé' => 'ROLE_EMPLOYEE'
                    ]
                ]
            ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne sont pas identiques.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => false,
                'first_options' => ['label' => 'Mot de Passe'],
                'second_options' => ['label' => 'Confirmez votre mot de passe'],
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe devrait contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add("Envoyer", SubmitType::class, [
                'attr' => ['class' => 'btn btn-dark'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
