<?php


namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 50; $i++) {
            $brand = new Brand();
            $brand->setName($faker->word);
            $manager->persist($brand);
            $this->addReference('brand_' . $i, $brand);
        }
        $manager->flush();
    }
}
