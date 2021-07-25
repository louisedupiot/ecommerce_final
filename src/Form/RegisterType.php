<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email' ,EmailType::class , [
                'label' => 'Votre Email',
                'constraints'=> new Length([
                    'min' =>2,
                   'max' => 60
                ]),
                'attr' => [
                    'placeholder' =>'Saisir votre Email'
                ]
            ])
            ->add('nom' , TextType::class ,[
                'label' => "Votre Nom",
                'constraints'=> new Length([
                    'min' =>2,
                   'max' => 60
                ]),

                'attr' => [
                    'placeholder' =>'Saisir votre Nom'
                ]
            ])
            ->add('prenom', TextType::class , [
                'label' => "Votre Prenom",
                'constraints'=> new Length([
                    'min' =>2,
                   'max' => 60
                ]),
                'attr' => [
                    'placeholder' =>'Saisir votre Prénom'
                ]
            ])
            ->add('password' ,RepeatedType::class ,[
                'type' => PasswordType::class,
                'label'=>"Mot de passe",
                'required'=> true,
                'first_options' => 
                [
                    'label' =>'mot de passe' ,
                    'attr' =>
                    [
                        'placeholder' => 'Saisir son mot de passe'
                    ]
                ],
                'second_options' =>
                [
                    'label' => 'Confirmer votre mot de passe',
                    'attr' =>
                    [
                        'placeholder' => 'Confirmer son mot de passe'
                    ]
                
                ],
                

            ])
       
        ->add('submit', SubmitType::class , [
            'label' =>"S'inscrire"
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
