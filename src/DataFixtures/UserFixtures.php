<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;


    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 500; $i++) {
            $subscriber = new User();
            $subscriber-> setUsername($faker->firstName);
            $subscriber-> setEmail($faker->email);
            $subscriber-> setRoles(['ROLE_SUBSCRIBER']);
            $subscriber-> setPassword($this->passwordEncoder->encodePassword($subscriber, 'subscriberpassword'));
            $manager->persist($subscriber);
        }
        $subscriber = new User();
        $subscriber-> setUsername('username');
        $subscriber-> setEmail('username@monsite.com');
        $subscriber-> setRoles(['ROLE_SUBSCRIBER']);
        $subscriber-> setPassword($this->passwordEncoder->encodePassword($subscriber, 'subscriberpassword'));
        $manager->persist($subscriber);

        $admin = new User();
        $admin->setUsername('admin');
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'adminpassword'));
        $manager->persist($admin);
        $manager->flush();
    }
}
