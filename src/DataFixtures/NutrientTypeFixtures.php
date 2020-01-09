<?php


namespace App\DataFixtures;

use App\Entity\NutrientType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class NutrientTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++) {
            $nutrient = new NutrientType();
            $nutrient->setNutrient($faker->word);
            $manager->persist($nutrient);
            $this->addReference('nutrient_' . $i, $nutrient);
        }
        $manager->flush();
    }
}
