<?php

namespace App\DataFixtures;

use App\Entity\OrderLine;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderLinesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $orderLine = new OrderLine();
        $orderLine->setCatServLines($this->getReference("Drap/Repasse"));
        $orderLine->setOrders($this->getReference("order1"));
        $manager->persist($orderLine);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoriesServicesFixtures::class,
            OrdersFixtures::class
        ];
    }
}
