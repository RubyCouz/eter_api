<?php

namespace App\Repository;

use App\Entity\EterState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterState|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterState|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterState[]    findAll()
 * @method EterState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterState::class);
    }

    // /**
    //  * @return EterState[] Returns an array of EterState objects
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
    public function findOneBySomeField($value): ?EterState
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
