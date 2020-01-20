<?php


namespace App\DataFixtures;

use App\Entity\Faq;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FaqFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 1; $i <= 8; $i++) {
            $faqFixtures = new Faq();
            $faqFixtures->setTitle($faker->sentence(6, true));
            $faqFixtures->setQuestion($faker->sentence(10, true));
            $faqFixtures->setAnswer($faker->paragraphs(1, true));

            $manager->persist($faqFixtures);
        }

        $manager->flush();
    }
}
