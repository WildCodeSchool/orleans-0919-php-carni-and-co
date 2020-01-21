<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Brand;
use App\Entity\Food;
use App\Entity\Product;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'required' => false,
                'download_uri' => false
            ])
            ->add('animal', EntityType::class, [
                'class' => Animal::class,
                'choice_label' => 'name',
                'label' => 'Animal',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.name', 'ASC');
                },
            ])
            ->add('food', EntityType::class, [
                'class' => Food::class,
                'choice_label' => 'type',
                'label' => 'Aliment',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('f')
                        ->orderBy('f.type', 'ASC');
                },
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'choice_label' => 'name',
                'label' => 'Marque',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                        ->orderBy('b.name', 'ASC');
                },
            ])
            ->add('bring', BringType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
