<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ServicesFixtures extends Fixture
{
      public function load(ObjectManager $manager): void
      {
            $service = new Service();
            $service->setName("Repassage");
            $service->setImage("fer2.svg");
            $service->setDescription("Un repassage adapté qui respecte la matière de votre linge tout 
                  en vous assurant un résultat sans un pli.");
            $this->addReference("Repassage", $service);
            $manager->persist($service);

            $service2 = new Service();
            $service2->setName("Défroissage");
            $service2->setImage("fer2.svg");
            $service2->setDescription("Pour redonner un petit coup de fraîcheur à votre linge délicat.
                   Toujours garanti sans un pli.");
            $this->setReference("Defroissage", $service2);
            $manager->persist($service2);

            $service3 = new Service();
            $service3->setName("Lavage");
            $service3->setImage("machine2.svg");
            $service3->setDescription("Un lavage adapté à votre linge qui vous assure une 
                  propreté avec des produits écologiques et une fraîcheur qui reste longtemps.");
            $this->setReference("Lavage", $service3);
            $manager->persist($service3);

            $service4 = new Service();
            $service4->setName("Nettoyage à sec");
            $service4->setImage("machine2.svg");
            $service4->setDescription("Un nettoyage à sec classique adapté à votre linge qui vous assure une 
                  propreté avec des produits écologiques et une fraîcheur qui reste longtemps.");
            $this->setReference("Nettoyage", $service4);
            $manager->persist($service4);

            $service5 = new Service();
            $service5->setName("Couture/Retouche");
            $service5->setImage("costume2.svg");
            $service5->setDescription("Un service de couture et retouche pour tous les petits imprévus
                  et pour garder votre linge le plus longtemps possible en état");
            $this->setReference("Couture", $service5);
            $manager->persist($service5);

            $service6 = new Service();
            $service6->setName("Animaux");
            $service6->setImage("animal.png");
            $service6->setDescription("Un service de qualité pour faire profiter du bien-être à vos amis à quatre pattes");
            $this->setReference("Animaux", $service6);
            $manager->persist($service6);

            $manager->flush();
      }
}