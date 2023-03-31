<?php

namespace App\Form;

use App\Entity\Shoes;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShoesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price')
            ->add('size')
            ->add('sex')
            ->add('category')
            ->add('dateadd')
            ->add('description')
            ->add('quantity')
            ->add('name')
            ->add('imageFile', VichFileType::class, [
                    'required' => false,
                    'allow_delete' => false,
                    'download_uri' => false,
                    
                ])
               
            ;
            

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Shoes::class,
        ]);
    }
}
