<?php


namespace App\DataFixtures;

use App\Entity\Composition;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;

class CompositionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 2500; $i++) {
            $composition = new Composition();
            $composition->setPercentage($faker->numberBetween(0, 20));
            $composition->setIngredient($this->getReference('ingredient_'.random_int(1, 250)));
            $composition->setProduct($this->getReference('product_'. ceil($i/5)));

            $manager->persist($composition);
            $this->addReference('composition_' . $i, $composition);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [ProductFixtures::class, IngredientFixtures::class];
    }
}
