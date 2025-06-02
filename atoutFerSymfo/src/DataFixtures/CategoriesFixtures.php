<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = new Category();
        $category->setName("Linge de maison");
        $category->setImage("panier.png");
        $manager->persist($category);

        $category2 = new Category();
        $category2->setName("Ameublement");
        $category2->setImage("canape.png");
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName("Rideaux/Voilages");
        $category3->setImage("rideaux.png");
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName("Costumes");
        $category4->setImage("costume2.svg");
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName("Vêtements");
        $category5->setImage("vetement.png");
        $manager->persist($category5);

        $category6 = new Category();
        $category6->setName("Animaux");
        $category6->setImage("animal.png");
        $manager->persist($category6);

        $category7 = new Category();
        $category7->setName("Drap plat");
        $category7->setImage("panier.png");
        $category7->setParent($category);
        $this->setReference("Drap plat", $category7);
        $manager->persist($category7);

        $category8 = new Category();
        $category8->setName("Drap housse");
        $category8->setImage("panier.png");
        $category8->setParent($category);
        $this->setReference("Drap housse", $category8);
        $manager->persist($category8);

        $category9 = new Category();
        $category9->setName("Couette");
        $category9->setImage("panier.png");
        $category9->setParent($category);
        $this->setReference("Couette", $category9);
        $manager->persist($category9);

        $category10 = new Category();
        $category10->setName("Serviette de bain");
        $category10->setImage("panier.png");
        $category10->setParent($category);
        $this->setReference("Serviette", $category10);
        $manager->persist($category10);

        $category11 = new Category();
        $category11->setName("Housse de canapé");
        $category11->setImage("canape.png");
        $category11->setParent($category2);
        $this->setReference("Canape", $category11);
        $manager->persist($category11);

        $category12 = new Category();
        $category12->setName("Housse de fauteuil");
        $category12->setImage("canape.png");
        $category12->setParent($category2);
        $this->setReference("Fauteuil", $category12);
        $manager->persist($category12);

        $category13 = new Category();
        $category13->setName("Rideau occultant");
        $category13->setImage("rideaux.png");
        $category13->setParent($category3);
        $this->setReference("RideauO", $category13);
        $manager->persist($category13);

        $category14 = new Category();
        $category14->setName("Rideau opaque");
        $category14->setImage("rideaux.png");
        $category14->setParent($category3);
        $this->setReference("RideauOP", $category14);
        $manager->persist($category14);

        $category15 = new Category();
        $category15->setName("Voilage");
        $category15->setImage("rideaux.png");
        $category15->setParent($category3);
        $this->setReference("Voilage", $category15);
        $manager->persist($category15);

        $category16 = new Category();
        $category16->setName("Ensemble de costume");
        $category16->setImage("costume2.svg");
        $category16->setParent($category4);
        $this->setReference("Costume", $category16);
        $manager->persist($category16);

        $category17 = new Category();
        $category17->setName("Robe de soirée");
        $category17->setImage("costume2.svg");
        $category17->setParent($category4);
        $this->setReference("Robe", $category17);
        $manager->persist($category17);

        $category18 = new Category();
        $category18->setName("Chemise");
        $category18->setImage("vetement.png");
        $category18->setParent($category5);
        $this->setReference("Chemise", $category18);
        $manager->persist($category18);

        $category19 = new Category();
        $category19->setName("Pantalon");
        $category19->setImage("vetement.png");
        $category19->setParent($category5);
        $this->setReference("Pantalon", $category19);
        $manager->persist($category19);

        $category20 = new Category();
        $category20->setName("Jeans");
        $category20->setImage("vetement.png");
        $category20->setParent($category5);
        $this->setReference("Jeans", $category20);
        $manager->persist($category20);

        $category21 = new Category();
        $category21->setName("Blouson");
        $category21->setImage("vetement.png");
        $category21->setParent($category5);
        $this->setReference("Blouson", $category21);
        $manager->persist($category21);

        $category22 = new Category();
        $category22->setName("Veste");
        $category22->setImage("vetement.png");
        $category22->setParent($category5);
        $this->setReference("Veste", $category22);
        $manager->persist($category22);

        $category23 = new Category();
        $category23->setName("Housse de panière");
        $category23->setImage("animal.png");
        $category23->setParent($category6);
        $this->setReference("Paniere", $category23);
        $manager->persist($category23);

        $category24 = new Category();
        $category24->setName("Tapis pour animal");
        $category24->setImage("animal.png");
        $category24->setParent($category6);
        $this->setReference("Tapis", $category24);
        $manager->persist($category24);

        $manager->flush();
    }
}
