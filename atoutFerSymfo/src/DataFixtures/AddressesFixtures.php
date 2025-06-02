<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AddressesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $address = new Address();
        $address->setNumber("36");
        $address->setStreet("rue des Fleurs");
        $address->setPostcode("63000");
        $address->setCity('Clermont-Ferrand');
        $address->setUserAddress($this->getReference("Lambda"));
        $this->setReference('adresse1', $address);
        $manager->persist($address);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class
        ];
    }
}
