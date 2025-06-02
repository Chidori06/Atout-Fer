<?php

namespace App\DataFixtures;

use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $status = new Status();
        $status->setName("En attente de validation");
        $this->setReference("validation", $status);
        $manager->persist($status);

        $status2 = new Status();
        $status2->setName("En cours de traitement");
        $this->setReference("traitement", $status2);
        $manager->persist($status2);

        $status3 = new Status();
        $status3->setName("Livraison en cours");
        $this->setReference("livraison", $status3);
        $manager->persist($status3);

        $status4 = new Status();
        $status4->setName("Terminé");
        $this->setReference("termine", $status4);
        $manager->persist($status4);

        $manager->flush();
    }
}
