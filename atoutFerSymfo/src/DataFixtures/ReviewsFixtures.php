<?php

namespace App\DataFixtures;

use App\Entity\Review;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReviewsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $review = new Review();
        $review->setUser($this->getReference("Lambda"));
        $review->setRating(4);
        $review->setContent("Un pressing de qualité qui en ravira plus d'un. Je recommande pleinement.");
        $manager->persist($review);
        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            UserFixtures::class

        ];
    }
}
