<?php


namespace App\DataFixtures;

use App\Entity\Nutrient;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class NutrientFixtures extends Fixture
{
    const NUTRIENTS = [
        'Les protéines',
        'Les glucides',
        'Les graisses',
        'Oméga-6',
        'Oméga-3',
        'Oméga-9',
        'Huile de coco',
        'Les vitamines',
        'Les minéraux',
        'L\'eau'
    ];
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        foreach (self::NUTRIENTS as $nutrientName) {
            $nutrientFixtures = new Nutrient();
            $nutrientFixtures->setName($nutrientName);
            $nutrientFixtures->setUpdatedAt($faker->dateTime());
            $nutrientFixtures->setDescription($faker->paragraphs(4, true));

            $manager->persist($nutrientFixtures);
        }

        $manager->flush();
    }
}
