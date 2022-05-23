<?php

namespace App\DataFixtures;

use App\Entity\Media;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MediaFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $imageMute = new Media();
        $imageMute->setPath('grab-mute1.jpg');
        $imageMute->setType('Image');
        $imageMute->setTrickMedia($this->getReference(TrickFixtures::MUTE_REFERENCE));
        $manager->persist($imageMute);

        $imageGrab = new Media();
        $imageGrab->setPath('grab1.jpg');
        $imageGrab->setType('Image');
        $imageGrab->setTrickMedia($this->getReference(TrickFixtures::MUTE_REFERENCE));
        $manager->persist($imageGrab);

        $imageSad = new Media();
        $imageSad->setPath('grab2.jpg');
        $imageSad->setType('Image');
        $imageSad->setTrickMedia($this->getReference(TrickFixtures::SAD_REFERENCE));
        $manager->persist($imageSad);

        $imageFlip = new Media();
        $imageFlip->setPath('demi-tour.jpg');
        $imageFlip->setType('Image');
        $imageFlip->setTrickMedia($this->getReference(TrickFixtures::MUTE_REFERENCE));
        $manager->persist($imageFlip);

        $videoGrab = new Media();
        $videoGrab->setPath('KEdFwJ4SWq4');
        $videoGrab->setType('VideoEmbed');
        $videoGrab->setTrickMedia($this->getReference(TrickFixtures::SAD_REFERENCE));
        $manager->persist($videoGrab);

        $videoFlip = new Media();
        $videoFlip->setPath('180-rotation.mp4');
        $videoFlip->setType('VideoFile');
        $videoFlip->setTrickMedia($this->getReference(TrickFixtures::DEMI_REFERENCE));
        $manager->persist($videoFlip);


        $manager->flush();
    }

    public function getDependencies()
    {
        return [TrickFixtures::class];
    }
}