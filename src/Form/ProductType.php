<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Brand;
use App\Entity\Food;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'name',
                'label' => 'Animal'
            ])
            ->add('food', EntityType::class, [
                'class' => Food::class,
                'choice_label' => 'type',
                'label' => 'Aliment'
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'label' => 'Marque'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
