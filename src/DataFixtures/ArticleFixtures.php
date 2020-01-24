<?php


namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++) {
            $article = new Article();
            $article->setTitle($faker->sentence(6));
            $article->setImage($faker->imageUrl());
            $article->setDescription($faker->sentence(500, true));
            $article->setDate($faker->dateTime);
            $article->setUpdatedAt($faker->dateTime());

            $manager->persist($article);
            $this->addReference('article_' . $i, $article);
        }
        $manager->flush();
    }
}
