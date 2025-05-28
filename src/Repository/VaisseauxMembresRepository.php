<?php

namespace App\Repository;

use App\Entity\VaisseauxMembres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VaisseauxMembres>
 */
class VaisseauxMembresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VaisseauxMembres::class);
    }

    //    /**
    //     * @return VaisseauxMembres[] Returns an array of VaisseauxMembres objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('v.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?VaisseauxMembres
    //    {
    //        return $this->createQueryBuilder('v')
    //            ->andWhere('v.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function getAll(): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.id', 'ASC') // Tri optionnel
            ->getQuery()
            ->getResult();
    }
}
