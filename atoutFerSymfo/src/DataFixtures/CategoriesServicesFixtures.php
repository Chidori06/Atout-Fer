<?php

namespace App\DataFixtures;

use App\Entity\CategoryService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CategoriesServicesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $categServ = new CategoryService();
        $categServ->setCategories($this->getReference("Drap plat"));
        $categServ->setServices($this->getReference("Repassage"));
        $categServ->setPrice(15);
        $this->addReference("Drap/Repasse", $categServ);
        $manager->persist($categServ);

        $categServ2 = new CategoryService();
        $categServ2->setCategories($this->getReference("Chemise"));
        $categServ2->setServices($this->getReference("Repassage"));
        $categServ2->setPrice(10);
        $this->setReference("Chemise/Repasse", $categServ2);
        $manager->persist($categServ2);

        $categServ3 = new CategoryService();
        $categServ3->setCategories($this->getReference("Pantalon"));
        $categServ3->setServices($this->getReference("Repassage"));
        $categServ3->setPrice(10);
        $this->setReference("Panta/Repasse", $categServ3);
        $manager->persist($categServ3);

        $categServ4 = new CategoryService();
        $categServ4->setCategories($this->getReference("RideauO"));
        $categServ4->setServices($this->getReference("Defroissage"));
        $categServ4->setPrice(15);
        $this->setReference("Rideau/Defroi", $categServ4);
        $manager->persist($categServ4);

        $categServ5 = new CategoryService();
        $categServ5->setCategories($this->getReference("Robe"));
        $categServ5->setServices($this->getReference("Defroissage"));
        $categServ5->setPrice(15);
        $this->setReference("Robe/Defroi", $categServ5);
        $manager->persist($categServ5);

        $categServ6 = new CategoryService();
        $categServ6->setCategories($this->getReference("Paniere"));
        $categServ6->setServices($this->getReference("Lavage"));
        $categServ6->setPrice(20);
        $this->setReference("Paniere/Lave", $categServ6);
        $manager->persist($categServ6);

        $categServ7 = new CategoryService();
        $categServ7->setCategories($this->getReference("Canape"));
        $categServ7->setServices($this->getReference("Lavage"));
        $categServ7->setPrice(20);
        $this->setReference("Canap/Lave", $categServ7);
        $manager->persist($categServ7);

        $categServ8 = new CategoryService();
        $categServ8->setCategories($this->getReference("Costume"));
        $categServ8->setServices($this->getReference("Nettoyage"));
        $categServ8->setPrice(15);
        $this->setReference("Costume/Nett", $categServ8);
        $manager->persist($categServ8);

        $categServ9 = new CategoryService();
        $categServ9->setCategories($this->getReference("Robe"));
        $categServ9->setServices($this->getReference("Nettoyage"));
        $categServ9->setPrice(15);
        $this->setReference("Robe/Nett", $categServ9);
        $manager->persist($categServ9);

        $categServ10 = new CategoryService();
        $categServ10->setCategories($this->getReference("Costume"));
        $categServ10->setServices($this->getReference("Couture"));
        $categServ10->setPrice(20);
        $this->setReference("Costume/Cout", $categServ10);
        $manager->persist($categServ10);

        $categServ11 = new CategoryService();
        $categServ11->setCategories($this->getReference("Chemise"));
        $categServ11->setServices($this->getReference("Couture"));
        $categServ11->setPrice(20);
        $this->setReference("Chemise/Nett", $categServ11);
        $manager->persist($categServ11);

        $categServ12 = new CategoryService();
        $categServ12->setCategories($this->getReference("Tapis"));
        $categServ12->setServices($this->getReference("Animaux"));
        $categServ12->setPrice(20);
        $this->setReference("Tapis/Anim", $categServ12);
        $manager->persist($categServ12);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoriesFixtures::class,
            ServicesFixtures::class
        ];
    }
}
