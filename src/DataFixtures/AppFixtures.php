<?php

namespace App\DataFixtures;

use App\Entity\Marques;
use App\Entity\Membres;
use App\Entity\Rank;
use App\Entity\Size;
use App\Entity\Vaisseaux;
use Doctrine\Bundle\FixturesBundle\Fixture;
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

        // Finalisation
        $manager->flush();
    }

    private function nullOrFloat(?string $value): ?float
    {
        return ($value === null || $value === '') ? null : (float)$value;
    }
}