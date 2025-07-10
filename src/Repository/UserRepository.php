<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function getAll(): array
    {
        return $this->createQueryBuilder('u')
            ->select('partial u.{id, pseudo, email, roles, isValid}') // On sélectionne uniquement certains champs
            ->orderBy('u.id', 'ASC') // Tri optionnel
            ->getQuery()
            ->getResult();
    }

    public function getOneById($id): ?User
    {
        return $this->createQueryBuilder('u')
            ->select('partial u.{id, pseudo, email, roles, isValid}') // On sélectionne uniquement certains champs
            ->orderBy('u.id', 'ASC') // Tri optionnel
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getAllAttente(): array
    {
        return $this->createQueryBuilder('u')
            ->select('partial u.{id, pseudo, email, roles, isValid}') // On sélectionne uniquement certains champs
            ->where('u.isValid = 0')
            ->orderBy('u.id', 'ASC') // Tri optionnel
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return UserFixtures[] Returns an array of UserFixtures objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('u.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?UserFixtures
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
