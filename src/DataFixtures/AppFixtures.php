<?php

namespace App\DataFixtures;

use App\Entity\Membres;
use App\Entity\Rank;
use App\Entity\Vaisseaux;
use App\Entity\VaisseauxMembres;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $ranks = [
            ['id' => 1,  'libelle' => 'Amiral',        'hierarchie' => 1],
            ['id' => 2,  'libelle' => 'Vice-Amiral',   'hierarchie' => 2],
            ['id' => 3,  'libelle' => 'Commandant',    'hierarchie' => 3],
            ['id' => 4,  'libelle' => 'Capitaine',     'hierarchie' => 4],
            ['id' => 5,  'libelle' => 'Lieutenant',    'hierarchie' => 5],
            ['id' => 6,  'libelle' => 'Sergent',       'hierarchie' => 6],
            ['id' => 7,  'libelle' => 'Caporal',       'hierarchie' => 7],
            ['id' => 8,  'libelle' => '1ère Classe',   'hierarchie' => 8],
            ['id' => 9,  'libelle' => '2nd Classe',    'hierarchie' => 9],
            ['id' => 10, 'libelle' => '3ème Classe',   'hierarchie' => 10],
            ['id' => 11, 'libelle' => 'Cadet',         'hierarchie' => 11],
        ];

        foreach ($ranks as $data) {
            $rank = new Rank();
            $rank->setId($data['id']); // facultatif si id auto-incrémenté
            $rank->setLibelle($data['libelle']);
            $rank->setHierachie($data['hierarchie']);
            $manager->persist($rank);
        }

        $testMember = new Membres();
        $testMember->setId(1);
        $testMember->setPseudo("Grabibi");
        $testMember->setNom("Grabriel");
        $testMember->setJoinDate(new \DateTime());
        $testMember->setRankId(1);
        $testMember->setIsActif(1);
        $manager->persist($testMember);

        $nomad = new Vaisseaux();
        $nomad->setNom("Nomad");
        $nomad->setMarque(1);
        $nomad->setRealeaseDate(new \DateTime());
        $nomad->setSCU(24);
        $nomad->setHeight(24);
        $nomad->setWidth(24);
        $nomad->setLength(24);
        $nomad->setSizeCategory(1);
        $nomad->setType(1);
        $nomad->setIsReleased(true);
        $manager->persist($nomad);

        $vaisseauMembre = new VaisseauxMembres();
        $vaisseauMembre->setMembreId(1);
        $vaisseauMembre->setVaisseauId(1);
        $manager->persist($vaisseauMembre);
        $manager->flush();
    }
}
