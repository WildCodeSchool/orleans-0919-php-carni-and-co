<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5; $i++) {
            $subscriber = new User();
            $subscriber-> setUsername('username');
            $subscriber-> setRoles(['ROLE_SUBSCRIBER']);
            $subscriber-> setPassword($this->passwordEncoder->encodePassword($subscriber, 'subscriberpassword'));
            $manager->persist($subscriber);
            $admin = new User();
            $admin->setUsername('username');
            $admin->setRoles(['ROLE_ADMIN']);
            $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'adminpassword'));
            $manager->persist($admin);
        }
        $manager->flush();
    }
}
