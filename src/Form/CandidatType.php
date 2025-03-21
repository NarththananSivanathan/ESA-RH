<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Sodium\add;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civilite',ChoiceType::class,
                [
                    'choices'=> [
                        "Monsieur" => "monsieur",
                        "Madame" => "madame",
                        "Autre" => "autre"
                    ],
                    'required' => true,
                ]
            )
            ->add('nom', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('prenom', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('telephone', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('email', EmailType::class,
                [
                    'required' => true,
                ]
            )

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'motdepasse'],
                'second_options' => ['label' => 'confirmation'],
            ])

            ->add('adresse', AdresseType::class)

            ->add('submit',SubmitType::class,[
                    'label' => "Valider"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class'=> Candidat::class
        ]);
    }
}
