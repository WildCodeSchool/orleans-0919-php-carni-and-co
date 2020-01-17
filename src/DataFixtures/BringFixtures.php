<?php


namespace App\DataFixtures;

use App\Entity\Bring;
use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BringFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 500; $i++) {
            $bring = new Bring();
            $bring->setAsh($faker->randomFloat(2, 0, 20));
            $bring->setCalcium($faker->randomFloat(2, 0, 100));
            $bring->setCalorie($faker->randomFloat(2, 0, 100));
            $bring->setCarbohydrate($faker->randomFloat(2, 0, 20));
            $bring->setFiber($faker->randomFloat(2, 0, 20));
            $bring->setHumidity($faker->randomFloat(2, 0, 20));
            $bring->setLipid($faker->randomFloat(2, 0, 20));
            $bring->setOmega3($faker->randomFloat(2, 0, 100));
            $bring->setOmega6($faker->randomFloat(2, 0, 100));
            $bring->setPhosphorus($faker->randomFloat(2, 0, 100));
            $bring->setProtein($faker->randomFloat(2, 0, 20));
            $manager->persist($bring);
            $this->addReference('bring_' . $i, $bring);
        }
        $manager->flush();
    }
}
