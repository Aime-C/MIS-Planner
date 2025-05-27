<?php

namespace App\DataFixtures;

use App\Entity\Membres;
use App\Entity\Rank;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ranks = [
            ['id' => 1, 'libelle' => 'Amiral',        'hierarchie' => 1],
            ['id' => 2, 'libelle' => 'Commandant',    'hierarchie' => 2],
            ['id' => 3, 'libelle' => 'Capitaine',     'hierarchie' => 3],
            ['id' => 4, 'libelle' => 'Lieutenant',    'hierarchie' => 4],
            ['id' => 5, 'libelle' => 'Sergent',       'hierarchie' => 5],
            ['id' => 6, 'libelle' => '1ère Classe',   'hierarchie' => 6],
            ['id' => 7, 'libelle' => '2ème Classe',   'hierarchie' => 7],
            ['id' => 8, 'libelle' => '3ème Classe',   'hierarchie' => 8],
            ['id' => 9, 'libelle' => 'Cadet',         'hierarchie' => 9],
        ];

        foreach ($ranks as $data) {
            $rank = new Rank();
            $rank->setId($data['id']); // facultatif si id auto-incrémenté
            $rank->setLibelle($data['libelle']);
            $rank->setHierachie($data['hierarchie']);
            $manager->persist($rank);
        }

        $testMember = new Membres();
        $testMember->setPseudo("Grabibi");
        $testMember->setNom("Grabriel");
        $testMember->setJoinDate(new \DateTime());
        $testMember->setRankId(1);
        $manager->persist($testMember);

        $manager->flush();
    }
}
