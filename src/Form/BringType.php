<?php

namespace App\Form;

use App\Entity\Bring;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BringType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('calories')
            ->add('ratioProteinCalorie')
            ->add('proteins')
            ->add('lipids')
            ->add('ashes')
            ->add('fibers')
            ->add('humidity')
            ->add('carbohydrates')
            ->add('calcium')
            ->add('phosphorus')
            ->add('reportPhosphoCal')
            ->add('omega6')
            ->add('omega3')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bring::class,
        ]);
    }
}
