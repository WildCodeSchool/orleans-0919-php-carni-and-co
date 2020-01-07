<?php

namespace App\Form;

use App\Entity\Bring;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BringType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calories', NumberType::class, [
                'label' => 'Calories',
                'scale' => 2,
            ])
            ->add('proteins', NumberType::class, [
                'label' => 'Protéines',
                'scale' => 2,
            ])
            ->add('lipids', NumberType::class, [
                'label' => 'Lipides',
                'scale' => 2,
            ])
            ->add('ashes', NumberType::class, [
                'label' => 'Cendres',
                'scale' => 2,
            ])
            ->add('fibers', NumberType::class, [
                'label' => 'Fibres',
                'scale' => 2,
            ])
            ->add('humidity', NumberType::class, [
                'label' => 'Humidité',
                'scale' => 2,
            ])
            ->add('carbohydrates', NumberType::class, [
                'label' => 'Glucides',
                'scale' => 2,
            ])
            ->add('calcium', NumberType::class, [
                'label' => 'Calcium',
                'scale' => 2,
            ])
            ->add('phosphorus', NumberType::class, [
                'label' => 'Phosphore',
                'scale' => 2,
            ])
            ->add('omega6', NumberType::class, [
                'label' => 'Omega 6',
                'scale' => 2,
            ])
            ->add('omega3', NumberType::class, [
                'label' => 'Omega 3',
                'scale' => 2,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bring::class,
        ]);
    }
}
