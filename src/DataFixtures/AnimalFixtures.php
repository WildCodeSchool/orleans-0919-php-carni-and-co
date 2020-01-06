<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class AnimalFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ( $i = 1 ; $i <= 2 ; $i++ ) {
            $animal = new Animal();
            $animal->setName($faker->word);
            $animal->setDescription($faker->sentence);
            $animal->setImage($faker->imageUrl());

            $manager->persist($animal);
        }
        $manager->flush();
    }
}
