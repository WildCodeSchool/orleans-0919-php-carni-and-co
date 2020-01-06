<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Origin;
use App\Entity\Shape;
use App\Entity\NutrientType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('precisedType', CheckboxType::class, [
                'label' => 'Type précisé',
                'required'=>false,
                ])
            ->add('precisedPart', CheckboxType::class, [
                'label' => 'Morceau précisé',
                'required'=>false,
                ])
            ->add('note', NumberType::class, ["html5" => true])
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
