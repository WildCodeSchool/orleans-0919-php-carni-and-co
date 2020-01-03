<?php


namespace App\DataFixtures;

use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FoodFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++) {
            $food = new Food();
            $food->setType($faker->word);
            $food->setDescription($faker->sentence);
            $manager->persist($food);
            $this->addReference('food_' . $i, $food);
        }
        $manager->flush();
    }
}
