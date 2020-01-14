<?php


namespace App\DataFixtures;

use App\Entity\Origin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class OriginFixtures extends Fixture
{
    const ORIGIN = [
        'animale',
        'végétale',
        'aminés et minéraux',
        'chimique',
        'autre',
    ];

    public function load(ObjectManager $manager)
    {
        $originNumber = 0;
        foreach (self::ORIGIN as $origin) {
            $originFixture = new Origin();
            $originFixture->setName($origin);
            $manager->persist($originFixture);
            $this->addReference('origin_' . $originNumber, $originFixture);
            $originNumber ++;
        }
        $manager->flush();
    }
}
