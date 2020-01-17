<?php


namespace App\DataFixtures;

use App\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ShapeFixtures extends Fixture
{
    const SHAPE = [
        'brut',
        'texturant',
        'frais',
        'déshydraté',
        'désossé',
        'séché',
        'amidon',
        'arôme',
        'concassé',
        'moulu',
        'cuit',
        'rôti',
        'hydrolisé',
        'bouillon',
        'huile',
        'transformé',
    ];

    public function load(ObjectManager $manager)
    {
        $shapeNumber = 0;
        foreach (self::SHAPE as $shape) {
            $shapeFixture = new Shape();
            $shapeFixture->setName($shape);
            $manager->persist($shapeFixture);
            $this->addReference('shape_' . $shapeNumber, $shapeFixture);
            $shapeNumber ++;
        }
        $manager->flush();
    }
}
