<?php


namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class IngredientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 250; $i++) {
            $ingredient = new Ingredient();
            $ingredient->setName($faker->word);
            $ingredient->setPrecisedPart($faker->boolean);
            $ingredient->setPrecisedType($faker->boolean);
            $ingredient->setNote($faker->numberBetween(0, 20));
            $ingredient->setOrigin($this->getReference('origin_'.random_int(0, 4)));
            $ingredient->setShape($this->getReference('shape_'.random_int(0, 15)));
            $ingredient->setNutrientType($this->getReference('nutrient_'.random_int(0, 4)));

            $manager->persist($ingredient);
            $this->addReference('ingredient_' . $i, $ingredient);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [OriginFixtures::class, ShapeFixtures::class, NutrientTypeFixtures::class];
    }
}
