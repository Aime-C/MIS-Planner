<?php

namespace App\DataFixtures;

use App\Entity\Membres;
use App\Repository\RankRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MembresFixtures extends Fixture
{
    private RankRepository $rankRepository;

    public function __construct(RankRepository $rankRepository){
        $this->rankRepository = $rankRepository;
    }
    public function load(ObjectManager $manager): void
    {
        // 2. Membres test
        $testMember = new Membres();
        $testMember->setPseudo("Grabibi");
        $testMember->setNom("Grabriel");
        $testMember->setJoinDate(new \DateTime());
        $testMember->setRank($this->rankRepository->findOneByHierarchie(1)); // à améliorer si Rank devient une relation
        $testMember->setIsActif(true);
        $manager->persist($testMember);

        $testMember2 = new Membres();
        $testMember2->setPseudo("Cui'er");
        $testMember2->setNom("Alex");
        $testMember2->setJoinDate(new \DateTime());
        $testMember2->setRank($this->rankRepository->findOneByHierarchie(5)); // à améliorer si Rank devient une relation
        $testMember2->setIsActif(true);
        $manager->persist($testMember2);

        $manager->flush();
    }
}
