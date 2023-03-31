<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', NumberType::class,[
                'label'=>"prix",
                'required'=>false
            ])

            ->add('size', NumberType::class,[
                'label'=>"size",
                'required'=>false
            ])
            ->add('sex', ChoiceType::class,[
                'label'=>"sex",
                'choices' => [
                    'Homme' => "Homme",
                    'Femme' => "Femme",
                    'Unisex' => "Unisex",
                ],
                'required'=>false
                
            ])
            ->add('category', ChoiceType::class,[
                'label'=>"category",
                'choices' => [
                    'sneacker' => "sneacker",
                    'running' => "running",
                ],
                'required'=>false
            ])
            ->add('dateadd', ChoiceType::class, [
                'label' => 'Trier par date',
                'choices' => [
                    'Croissant' => 'r.dateadd ASC',
                    'Décroissant' => 'r.dateadd DESC'
                ],
                'required' => false
                ])

            
            ->add('name',TextType::class,[
                'label'=>"nom",
                'required'=>false,
                'attr'=>[
                    'placeholder'=>'Rechercher'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
