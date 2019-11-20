<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\PetStore;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PetStore|null find($id, $lockMode = null, $lockVersion = null)
 * @method PetStore|null findOneBy(array $criteria, array $orderBy = null)
 * @method PetStore[]    findAll()
 * @method PetStore[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PetStoreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PetStore::class);
    }
    // /**
    //  * @return PetStore[] Returns an array of PetStore objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PetStore
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
