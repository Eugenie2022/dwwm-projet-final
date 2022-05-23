<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $commentOne = new Comment();
        $commentOne->setContent('Ceci est le tout premier commentaire du site :)');
        $commentOne->setCreatedAt(new \DateTime());
        $commentOne->setTrickCom($this->getReference(TrickFixtures::MUTE_REFERENCE));
        $commentOne->setUserCom($this->getReference(UserFixtures::ADMIN_REFERENCE));
        $manager->persist($commentOne);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [TrickFixtures::class, UserFixtures::class];
    }
}
