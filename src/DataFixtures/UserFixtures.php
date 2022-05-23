<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const ADMIN_REFERENCE = "user-admin";
    public const USER_REFERENCE = "user";


    public function load(ObjectManager $manager): void
    {
         $admin = new User();
         $admin->setName('Ragon');
         $admin->setFirstname('Eugénie');
         $admin->setUserName('SuperAdmin');
         $admin->setEmail('eugenie@email.fr');
         $admin->setPassword('1234');
         $admin->setPhoto('pp-admin.jpg');
         $admin->setRoles(["ROLE_ADMIN"]);
         $manager->persist($admin);
         $this->addReference(self::ADMIN_REFERENCE, $admin);

        $john = new User();
        $john->setName('Doe');
        $john->setFirstname('John');
        $john->setUserName('Jojo');
        $john->setEmail('john.doe@email.fr');
        $john->setPassword('azerty');
        $john->setPhoto('pp-john.jpg');
        $john->setRoles(["ROLE_USER"]);
        $manager->persist($john);
        $this->addReference(self::USER_REFERENCE, $john);

        $manager->flush();
    }

}
