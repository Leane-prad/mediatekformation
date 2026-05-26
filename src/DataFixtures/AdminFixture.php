<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixture extends Fixture {

    private $passwordHasher;
    private $adminPassword;

    public function __construct(UserPasswordHasherInterface $passwordHasher, string $adminPassword) {
        $this->passwordHasher = $passwordHasher;
        $this->adminPassword = $adminPassword;
    }

    public function load(ObjectManager $manager): void {
        $user = new Admin();
        $user->setUsername("admin");
        
        $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $this->adminPassword
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);
        $manager->flush();
    }
}
