<?php

namespace App\Repository;

use App\Entity\EterEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterEvent[]    findAll()
 * @method EterEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterEvent::class);
    }

    // /**
    //  * @return EterEvent[] Returns an array of EterEvent objects
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
    public function findOneBySomeField($value): ?EterEvent
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
