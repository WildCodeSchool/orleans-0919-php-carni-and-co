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
            ->add('calorie', NumberType::class, [
                'label' => 'Calories',
                'scale' => 2,
            ])
            ->add('protein', NumberType::class, [
                'label' => 'Protéines',
                'scale' => 2,
            ])
            ->add('lipid', NumberType::class, [
                'label' => 'Lipides',
                'scale' => 2,
            ])
            ->add('ashe', NumberType::class, [
                'label' => 'Cendres',
                'scale' => 2,
            ])
            ->add('fiber', NumberType::class, [
                'label' => 'Fibres',
                'scale' => 2,
            ])
            ->add('humidity', NumberType::class, [
                'label' => 'Humidités',
                'scale' => 2,
            ])
            ->add('carbohydrate', NumberType::class, [
                'label' => 'Glucides',
                'scale' => 2,
            ])
            ->add('calcium', NumberType::class, [
                'label' => 'Calciums',
                'scale' => 2,
            ])
            ->add('phosphorus', NumberType::class, [
                'label' => 'Phosphores',
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
