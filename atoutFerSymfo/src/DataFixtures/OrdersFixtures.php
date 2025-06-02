<?php

namespace App\DataFixtures;

use App\Entity\Order;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrdersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $order = new Order();
        $order->setUser($this->getReference("Lambda"));
        $order->setAddress($this->getReference("adresse1"));
        $order->setOrderDate(new \DateTime('2024-03-28'));
        $order->setStatusOrder($this->getReference("traitement"));
        $order->setPayment("Carte Bancaire");
        $order->setTotal(25);
        $this->setReference("order1", $order);
        $manager->persist($order);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            AddressesFixtures::class,
            StatusesFixtures::class
        ];
    }
}
