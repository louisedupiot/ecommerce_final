<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true,
                'label' => 'Mon adresse email'
            ])
            
            ->add('nom', TextType::class, [
                'disabled' => true,
                'label' => 'Mon adresse email',
                'attr' => [
                    'placeholder' =>'Modifier votre nom'
                ]
                ])
            ->add('prenom', TextType::class, [
                    'disabled' => true,
                    'label' => 'Mon adresse email',
                    'attr' => [
                        'placeholder' =>'Modifier votre Prénom'
                    ]
                    ])
                    ->add('old_password' ,PasswordType::class ,[
                        'label' => "Mon mot de passe actuel",
                        'mapped' => false ,
                        'attr' =>[
                            'placeholder' => 'Veuillez saisir votre mot de passe actuel'
                        ]
                    ])
                    ->add('new_password' ,RepeatedType::class ,[
                        'type' => PasswordType::class,
                        'mapped' => false ,
                        'label'=>"Mon nouveau mot de passe",
                        'required'=> true,
                        'first_options' => 
                        [
                            'label' =>'Mon nouveau mot de passe' ,
                            'attr' =>
                            [
                                'placeholder' => 'Saisir votre nouveau mot de passe'
                            ]
                        ],
                        'second_options' =>
                        [
                            'label' => 'Confirmer votre nouveau mot de passe',
                            'attr' =>
                            [
                                'placeholder' => 'Confirmer votre nouveau mot de passe'
                            ],
                        ]
                        
        
                    ])
                   ->add('submit', SubmitType::class , [
                        'label' =>"Mettre à jour"
                   ]);
                }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
