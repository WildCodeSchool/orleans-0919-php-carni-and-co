<?php


namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ProductFixtures extends Fixture
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

            $manager->persist($product);
            $this->addReference('product_' . $i, $product);
        }
        $manager->flush();
    }
}
