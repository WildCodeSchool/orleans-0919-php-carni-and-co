<?php

namespace App\DataFixtures;

use App\Entity\Animal;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AnimalFixtures extends Fixture
{
    const ANIMALS = [
        'Chien' => [
            'name'=> 'Chien',
            'description' => 'Le Chien (Canis lupus familiaris) est la sous-espèce domestique de Canis lupus, un 
                              mammifère de la famille des Canidés (Canidae). C\'est un carnivore dit "opportuniste", il 
                              consomme essentiellement de la viande mais aussi quelques fruits et légumes si 
                              l\'occasion se présente. Il est également charognard.
                               7.3 millions de chiens en France en 2018.',
            'image' => 'chien.png',
        ],
        'Chat' => [
            'name'=> 'Chat',
            'description' => 'Le Chien (Canis lupus familiaris) est la sous-espèce domestique de Canis lupus, un 
                              mammifère de la famille des Canidés (Canidae). C\'est un carnivore dit "opportuniste", 
                              il consomme essentiellement de la viande mais aussi quelques fruits et légumes si 
                              l\'occasion se présente. Il est également charognard.
                              7.3 millions de chiens en France en 2018.',
            'image' => 'chat.png',
        ],
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::ANIMALS as $key => $data) {
            $animal = new Animal();
            $animal-> setName($key);
            $animal-> setDescription($data['description']);
            $animal-> setImage($data['image']);

            $manager -> persist($animal);
        }
        $manager->flush();
    }
}
