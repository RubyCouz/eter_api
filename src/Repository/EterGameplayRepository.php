<?php

namespace App\Repository;

use App\Entity\EterGameplay;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterGameplay|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterGameplay|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterGameplay[]    findAll()
 * @method EterGameplay[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterGameplayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterGameplay::class);
    }

    // /**
    //  * @return EterGameplay[] Returns an array of EterGameplay objects
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
    public function findOneBySomeField($value): ?EterGameplay
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
