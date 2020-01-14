<?php


namespace App\DataFixtures;

use App\Entity\NutrientType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class NutrientTypeFixtures extends Fixture
{
    const NUTRIENTS_TYPE = [
        'protéines',
        'glucides',
        'hydrique',
        'lait',
        'lipides',
    ];

    public function load(ObjectManager $manager)
    {
        $nutrientNumber = 0;
        foreach (self::NUTRIENTS_TYPE as $nutrientType) {
            $nutrient = new NutrientType();
            $nutrient->setNutrient($nutrientType);
            $manager->persist($nutrient);
            $this->addReference('nutrient_' . $nutrientNumber, $nutrient);
            $nutrientNumber ++;
        }
        $manager->flush();
    }
}
