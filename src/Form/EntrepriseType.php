<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('siret', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('code_naf', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('telephone', TextType::class,
                [
                    'required' => true,
                ]
            )
            ->add('telephone2')
            ->add('description', TextareaType::class,
                [
                    'required' => true,

                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
