<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const GRABS_REFERENCE = 'cat-grabs';
    public const ROT_REFERENCE = 'cat-rotation';
    public const FLIPS_REFERENCE = 'cat-flips';

    public function load(ObjectManager $manager): void
    {
        $grabs = new Category();
        $grabs->setNameCat('Grabs');
        $manager->persist($grabs);
        $this->addReference(self::GRABS_REFERENCE, $grabs);

        $rotation = new Category();
        $rotation->setNameCat('Rotations');
        $manager->persist($rotation);
        $this->addReference(self::ROT_REFERENCE, $rotation);

        $flips = new Category();
        $flips->setNameCat('Flips');
        $manager->persist($flips);
        $this->addReference(self::FLIPS_REFERENCE, $flips);

        $manager->flush();
    }


}
