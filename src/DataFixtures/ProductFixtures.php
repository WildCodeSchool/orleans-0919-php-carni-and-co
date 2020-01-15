<?php


namespace App\DataFixtures;

use App\Entity\Animal;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 500; $i++) {
            $product = new Product();
            $product->setReference($faker->word);
            $product->setCereal($faker->boolean(33));
            $product->setOrganic($faker->boolean(33));
            $product->setVegan($faker->boolean(33));
            $product->setAnimal($this->getReference('animal_' . rand(0, 1)));
            $product->setBrand($this->getReference('brand_' . rand(1, 50)));
            $product->setFood($this->getReference('food_' . rand(1, 15)));
            $product->setBring($this->getReference('bring_'. $i));
            for ($j = 1; $j <= 5; $j++) {
                $product->addIngredient($this->getReference('ingredient_'.rand(1, 250)));
            }

            $manager->persist($product);
            $this->addReference('product_' . $i, $product);
        }
        $manager->flush();
    }
    public function getDependencies()
    {
        return [AnimalFixtures::class, FoodFixtures::class, BrandFixtures::class, BringFixtures::class];
    }
}
