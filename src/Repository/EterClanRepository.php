<?php

namespace App\Repository;

use App\Entity\EterClan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterClan|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterClan|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterClan[]    findAll()
 * @method EterClan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterClanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterClan::class);
    }

    // /**
    //  * @return EterClan[] Returns an array of EterClan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EterClan
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
