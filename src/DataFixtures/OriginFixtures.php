<?php


namespace App\DataFixtures;

use App\Entity\Origin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class OriginFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++) {
            $origin = new Origin();
            $origin->setName($faker->word);
            $manager->persist($origin);
            $this->addReference('origin_' . $i, $origin);
        }
        $manager->flush();
    }
}
