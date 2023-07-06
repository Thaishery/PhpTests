<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasherInterface;

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->userPasswordHasherInterface = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("guillaume@mail.com");
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, "test_pass"
            )
        );
        $user->setFirstName("Guillaume");
        $user->setLastName("Dev");
        $user->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();
        
        unset($user);

        $user = new User();
        $user->setEmail("William@mail.com");
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword(
                $user, "test_pass"
            )
        );
        $user->setFirstName("William");
        $user->setLastName("Dev");
        $user->setRoles(["ROLE_ADMIN"]);

        $manager->persist($user);
        $manager->flush();
    }
}