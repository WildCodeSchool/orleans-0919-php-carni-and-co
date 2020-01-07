<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('vegan', CheckboxType::class, [
                'label' => 'Vegan',
                'required'=>false,
            ])
            ->add('organic', CheckboxType::class, [
                'label' => 'Bio',
                'required'=>false,
            ])
            ->add('cereal', CheckboxType::class, [
                'label' => 'Céréales',
                'required'=>false,
            ])
            ->add('source')
            ->add('barCode')
            ->add('image')
            ->add('animal')
            ->add('food')
            ->add('brand')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
