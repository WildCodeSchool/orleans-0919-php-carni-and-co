<?php


namespace App\DataFixtures;

use App\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ShapeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++) {
            $shape = new Shape();
            $shape->setName($faker->word);
            $manager->persist($shape);
            $this->addReference('shape_' . $i, $shape);
        }
        $manager->flush();
    }
}
