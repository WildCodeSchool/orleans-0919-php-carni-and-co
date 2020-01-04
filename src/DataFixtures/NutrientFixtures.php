<?php


namespace App\DataFixtures;

use App\Entity\Nutrient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class NutrientFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $nameProtein = 'Les protéines';

        $proteinFixtures = new Nutrient();
        $proteinFixtures->setName($nameProtein);
        $proteinFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $proteinFixtures->setImage($faker->imageUrl());

        $manager->persist($proteinFixtures);

        $nameCarbo = 'Les glucides';

        $carboHydrateFixtures = new Nutrient();
        $carboHydrateFixtures->setName($nameCarbo);
        $carboHydrateFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $carboHydrateFixtures->setImage($faker->imageUrl());

        $manager->persist($carboHydrateFixtures);


        $nameFat = 'Les graisses';

        $fatFixtures = new Nutrient();
        $fatFixtures->setName($nameFat);
        $fatFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $fatFixtures->setImage($faker->imageUrl());

        $manager->persist($fatFixtures);

        $nameOmega6 = 'Oméga-6';

        $omega6Fixtures = new Nutrient();
        $omega6Fixtures->setName($nameOmega6);
        $omega6Fixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $omega6Fixtures->setImage($faker->imageUrl());

        $manager->persist($omega6Fixtures);

        $nameOmega3 = 'Oméga-3';

        $omega3Fixtures = new Nutrient();
        $omega3Fixtures->setName($nameOmega3);
        $omega3Fixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $omega3Fixtures->setImage($faker->imageUrl());

        $manager->persist($omega3Fixtures);

        $nameOmega9 = 'Oméga-9';

        $omega9Fixtures = new Nutrient();
        $omega9Fixtures->setName($nameOmega9);
        $omega9Fixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $omega9Fixtures->setImage($faker->imageUrl());

        $manager->persist($omega9Fixtures);

        $nameCocoNut = 'Huile de coco';

        $cocoNutOilFixtures = new Nutrient();
        $cocoNutOilFixtures->setName($nameCocoNut);
        $cocoNutOilFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $cocoNutOilFixtures->setImage($faker->imageUrl());

        $manager->persist($cocoNutOilFixtures);

        $nameVitamin = 'Les vitamines';

        $vitaminFixtures = new Nutrient();
        $vitaminFixtures->setName($nameVitamin);
        $vitaminFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $vitaminFixtures->setImage($faker->imageUrl());

        $manager->persist($vitaminFixtures);

        $nameMineral = 'Les minéraux';

        $mineralFixtures = new Nutrient();
        $mineralFixtures->setName($nameMineral);
        $mineralFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $mineralFixtures->setImage($faker->imageUrl());

        $manager->persist($mineralFixtures);

        $nameWater = 'L\'eau';

        $waterFixtures = new Nutrient();
        $waterFixtures->setName($nameWater);
        $waterFixtures->setDescription($faker->paragraphs($nbSentences = 6, $variableNbSentences = true));
        $waterFixtures->setImage($faker->imageUrl());

        $manager->persist($waterFixtures);

        $manager->flush();
    }
}
