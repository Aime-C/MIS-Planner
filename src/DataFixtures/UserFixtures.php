<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $userAdmin = new \App\Entity\User();
        $userAdmin->setEmail('chaigneau851@gmail.com');
        $userAdmin->setRoles(['ROLE_ADMIN']);
        $userAdmin->setIsValid(1);
        $userAdmin->setPseudo('Well');
        $plaintextPassword = "1234";

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $userAdmin,
            $plaintextPassword
        );
        $userAdmin->setPassword($hashedPassword);
        $manager->persist($userAdmin);

        $user = new \App\Entity\User();
        $user->setEmail('dodo@gmail.com');
//        $user->setRoles(['ROLE_ATTENTE']);
        $user->setIsValid(0);
        $user->setPseudo('dodo248');
        $plaintextPassword = "1234";

        // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
