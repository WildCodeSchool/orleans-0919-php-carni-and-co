<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Origin;
use App\Entity\Shape;
use App\Entity\NutrientType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, ['label' => 'Nom'])
            ->add('precisedType', null, ['label' => 'Type précisé'])
            ->add('precisedPart', null, ['label' => 'Morceau précisé'])
            ->add('note')
            ->add('origin', EntityType::class, [
                'class' => Origin::class,
                'choice_label' => 'name',
                'label' => 'Origine'
            ])
            ->add('shape', EntityType::class, [
                'class' => Shape::class,
                'choice_label' => 'name',
                'label' => 'Forme'
            ])
            ->add('nutrientType', EntityType::class, [
                'class' => NutrientType::class,
                'choice_label' => 'nutrient',
                'label' => 'Type de nutriment'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
