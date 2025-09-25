<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RolesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
//        $role1 = new \App\Entity\Role();
//        $role1->setChef(0);
//        $role1->setLibelle("Ingénieur");
//        $role1->setColor("#1f1918");
//        $manager->persist($role1);
//
//        $role2 = new \App\Entity\Role();
//        $role2->setChef(1);
//        $role2->setLibelle("Chef Ingénieur");
//        $role2->setColor("#1f1918");
//        $manager->persist($role2);

        $roles = [
            ['libelle' => 'Ingénieur', 'color' => '#1f1918', 'chef' => 0],
            ['libelle' => 'Chef Ingénieur', 'color' => '#1f1918', 'chef' => 1],
            ['libelle' => 'Médic', 'color' => '#ed1d0e', 'chef' => 0],
            ['libelle' => 'Chef Médic', 'color' => '#ed1d0e', 'chef' => 1],

        ];
        foreach ($roles as $data) {
            $role = new Role();
            $role->setLibelle($data['libelle']);
            $role->setColor($data['color']);
            $role->setChef($data['chef']);
            $manager->persist($role);
        }
        $manager->flush();
    }
}