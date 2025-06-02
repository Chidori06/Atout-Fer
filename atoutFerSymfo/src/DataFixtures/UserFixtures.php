<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('admin@atoutfer.fr');
        $user->setFirstname('Bernard');
        $user->setLastname('Lechat');
        $user->setPassword($this->hasher->hashPassword($user, "AdminChat"));
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setBirthdate(new \DateTime('1985-03-15'));
        $user->setGender("Homme");

        $user2 = new User();
        $user2->setEmail('employee@atoutfer.fr');
        $user2->setFirstname('Claude');
        $user2->setLastname('Delta');
        $user2->setPassword($this->hasher->hashPassword($user, "EmployeChat"));
        $user2->setRoles(["ROLE_EMPLOYEE"]);
        $user2->setBirthdate(new \DateTime('1962-06-18'));
        $user2->setGender("Homme");

        $user3 = new User();
        $user3->setEmail('test@test.fr');
        $user3->setFirstname('Michel');
        $user3->setLastname('Lambda');
        $user3->setPassword($this->hasher->hashPassword($user, "TestChat"));
        $user3->setBirthdate(new \DateTime('1969-10-28'));
        $this->setReference("Lambda", $user3);
        $user3->setGender("Homme");


        $manager->persist($user);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->flush();
    }
}
