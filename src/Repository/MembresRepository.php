<?php

namespace App\Repository;

use App\Entity\Membres;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Membres>
 */
class MembresRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Membres::class);
    }

//        /**
//         * @return Membres[] Returns an array of Membres objects
//         */
//        public function findByExampleField($value): array
//        {
//            return $this->createQueryBuilder('m')
//                ->andWhere('m.exampleField = :val')
//                ->setParameter('val', $value)
//                ->orderBy('m.id', 'ASC')
//                ->getQuery()
//                ->getResult()
//            ;
//        }
    public function getAll(): array
    {
        return $this->createQueryBuilder('m')
            ->orderBy('m.rank_id', 'ASC') // Tri optionnel
            ->getQuery()
            ->getResult();
    }

    public function findOneByPseudo($value): ?Membres
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.pseudo = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneById($value): ?Membres
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}
