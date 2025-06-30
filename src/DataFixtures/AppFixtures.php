<?php

namespace App\DataFixtures;

use App\Entity\Marques;
use App\Entity\Membres;
use App\Entity\Rank;
use App\Entity\Size;
use App\Entity\Type;
use App\Entity\Vaisseaux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Types\Types;
use Doctrine\Persistence\ObjectManager;
use League\Csv\Reader;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Rangs
        $ranks = [
            ['libelle' => 'Amiral', 'hierarchie' => 1],
            ['libelle' => 'Vice-Amiral', 'hierarchie' => 2],
            ['libelle' => 'Commandant', 'hierarchie' => 3],
            ['libelle' => 'Capitaine', 'hierarchie' => 4],
            ['libelle' => 'Lieutenant', 'hierarchie' => 5],
            ['libelle' => 'Sergent', 'hierarchie' => 6],
            ['libelle' => 'Caporal', 'hierarchie' => 7],
            ['libelle' => '1ère Classe', 'hierarchie' => 8],
            ['libelle' => '2nd Classe', 'hierarchie' => 9],
            ['libelle' => '3ème Classe', 'hierarchie' => 10],
            ['libelle' => 'Cadet', 'hierarchie' => 11],
        ];

        foreach ($ranks as $data) {
            $rank = new Rank();
            $rank->setLibelle($data['libelle']);
            $rank->setHierachie($data['hierarchie']);
            $manager->persist($rank);
        }

        // 2. Membres test
        $testMember = new Membres();
        $testMember->setPseudo("Grabibi");
        $testMember->setNom("Grabriel");
        $testMember->setJoinDate(new \DateTime());
        $testMember->setRankId(1); // à améliorer si Rank devient une relation
        $testMember->setIsActif(true);
        $manager->persist($testMember);

        $testMember2 = new Membres();
        $testMember2->setPseudo("Cuiler");
        $testMember2->setNom("Alex");
        $testMember2->setJoinDate(new \DateTime());
        $testMember2->setRankId(5); // à améliorer si Rank devient une relation
        $testMember2->setIsActif(true);
        $manager->persist($testMember2);

        $sizeSmall = new Size();
        $sizeSmall->setSizeId(1);
        $sizeSmall->setLibelle("Small");
        $manager->persist($sizeSmall);

        $sizeMedium = new Size();
        $sizeMedium->setSizeId(2);
        $sizeMedium->setLibelle("Medium");
        $manager->persist($sizeMedium);

        $sizeLarge = new Size();
        $sizeLarge->setSizeId(3);
        $sizeLarge->setLibelle("Large");
        $manager->persist($sizeLarge);

        $sizeCapital = new Size();
        $sizeCapital->setSizeId(4);
        $sizeCapital->setLibelle("Capital");
        $manager->persist($sizeCapital);

        // 3. Marques (chargées d'abord pour pouvoir les lier ensuite)
        $marquesMap = []; // id_marque => entity
        $marquesCsv = Reader::createFromPath(__DIR__ . '/Data/marques.csv', 'r');
        $marquesCsv->setHeaderOffset(0);

        foreach ($marquesCsv->getRecords() as $record) {
            $marque = new Marques();
            $marque->setIdMarque((int) $record['id_marque']);
            $marque->setNom($record['nom']);
            $manager->persist($marque);

            $marquesMap[(int)$record['id_marque']] = $marque;
        }

        // 4. Vaisseaux (avec marque liée par entité)
        $vaisseauxCsvPath = __DIR__ . '/Data/ships.csv';
        $vaisseauxCsv = Reader::createFromPath($vaisseauxCsvPath, 'r');
        $vaisseauxCsv->setHeaderOffset(0);

        foreach ($vaisseauxCsv->getRecords() as $data) {
            $vaisseau = new Vaisseaux();
            $vaisseau->setNom($data['nom']);
            $vaisseau->setRealeaseDate(new \DateTime($data['realeaseDate']));
            $vaisseau->setSizeCategory((int)$data['sizeCategory']);
            $vaisseau->setIsReleased((bool)$data['isReleased']);
            $vaisseau->setHeight($this->nullOrFloat($data['height']));
            $vaisseau->setWidth($this->nullOrFloat($data['width']));
            $vaisseau->setLength($this->nullOrFloat($data['length']));
            $vaisseau->setSCU((int)$data['SCU']);
            $vaisseau->setType((int)$data['type']);
            $vaisseau->setImage($data['image'] ?? null);

            $marqueId = (int) $data['marque'];
            if (isset($marquesMap[$marqueId])) {
                $vaisseau->setMarque($marqueId); // OU: $vaisseau->setMarque($marquesMap[$marqueId]) si relation
            }

            $manager->persist($vaisseau);
        }

        $type = new Type();
        $type->setLibelle("Cargo");
        $type->setTypeId(1);
        $manager->persist($type);

        $type2 = new Type();
        $type2->setLibelle("Minage");
        $type2->setTypeId(2);
        $manager->persist($type2);

        $type3 = new Type();
        $type3->setLibelle("Salvage");
        $type3->setTypeId(3);
        $manager->persist($type3);

        $type4 = new Type();
        $type4->setLibelle("Construction");
        $type4->setTypeId(4);
        $manager->persist($type4);

        $type5 = new Type();
        $type5->setLibelle("Light fighter");
        $type5->setTypeId(5);
        $manager->persist($type5);

        $type6 = new Type();
        $type6->setLibelle("Medium fighter");
        $type6->setTypeId(6);
        $manager->persist($type6);

        $type7 = new Type();
        $type7->setLibelle("Heavy fighter");
        $type7->setTypeId(7);
        $manager->persist($type7);


        // Finalisation
        $manager->flush();
    }

    private function nullOrFloat(?string $value): ?float
    {
        return ($value === null || $value === '') ? null : (float)$value;
    }
}