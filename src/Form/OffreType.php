<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Offre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('salaire',TextType::class,
                [
                    'required' => true,
                ]

            )
            ->add('etude_min',TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('experience_min',TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('type_contrat',TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('nb_heure',TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('description',TextareaType::class,
                [
                    'required' => true,
                ]
            )
            ->add('prerequis',TextareaType::class,
                [
                    'required' => true,
                ]
            )
            ->add('submit',SubmitType::class,[
                'label' => "Créer l'offre"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
