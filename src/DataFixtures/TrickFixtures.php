<?php

namespace App\DataFixtures;

use App\Entity\Trick;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TrickFixtures extends Fixture implements DependentFixtureInterface
{
    public const MUTE_REFERENCE = 'trick-mute';
    public const DEMI_REFERENCE = 'trick-180';
    public const FRONT_REFERENCE = 'trick-front-flip';
    public const SAD_REFERENCE = 'trick-sad';


    public function load(ObjectManager $manager): void
    {
        $mute = new Trick();
        $mute->setNameTrick('Mute Grab');
        $mute->setDescription('Saisie de la carre frontside de la planche entre les deux pieds avec la main avant.');
        $mute->setCreatedAt(new \DateTime());
        $mute->setThumbnail('grab-mute-tb.jpg');
        $mute->setUserTrick($this->getReference(UserFixtures::ADMIN_REFERENCE));
        $mute->setCatTrick($this->getReference(CategoryFixtures::GRABS_REFERENCE));
        $manager->persist($mute);
        $this->addReference(self::MUTE_REFERENCE, $mute);

        $frontFlip = new Trick();
        $frontFlip->setNameTrick('Front Flip');
        $frontFlip->setDescription('Rotation vertical en avant.');
        $frontFlip->setCreatedAt(new \DateTime());
        $frontFlip->setThumbnail('front-flip-tb');
        $frontFlip->setUserTrick($this->getReference(UserFixtures::ADMIN_REFERENCE));
        $frontFlip->setCatTrick($this->getReference(CategoryFixtures::FLIPS_REFERENCE));
        $manager->persist($frontFlip);
        $this->addReference(self::FRONT_REFERENCE, $frontFlip);

        $demiTour = new Trick();
        $demiTour->setNameTrick('180');
        $demiTour->setDescription('un 180 désigne un demi-tour, soit 180 degrés d\'angle');
        $demiTour->setCreatedAt(new \DateTime());
        $demiTour->setThumbnail('180-rot-tb.jpg');
        $demiTour->setUserTrick($this->getReference(UserFixtures::ADMIN_REFERENCE));
        $demiTour->setCatTrick($this->getReference(CategoryFixtures::ROT_REFERENCE));
        $manager->persist($demiTour);
        $this->addReference(self::DEMI_REFERENCE, $demiTour);

        $sad = new Trick();
        $sad->setNameTrick('Sad Grab');
        $sad->setDescription('Saisie de la carre backside de la planche, entre les deux pieds, avec la main avant.');
        $sad->setCreatedAt(new \DateTime());
        $sad->setThumbnail('sad-grab-tb.jpg');
        $sad->setUserTrick($this->getReference(UserFixtures::ADMIN_REFERENCE));
        $sad->setCatTrick($this->getReference(CategoryFixtures::GRABS_REFERENCE));
        $manager->persist($sad);
        $this->addReference(self::SAD_REFERENCE, $sad);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class, CategoryFixtures::class];
    }
}
