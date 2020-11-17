<?php

namespace App\Repository;

use App\Entity\EterStreamer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterStreamer|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterStreamer|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterStreamer[]    findAll()
 * @method EterStreamer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterStreamerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterStreamer::class);
    }

    // /**
    //  * @return EterStreamer[] Returns an array of EterStreamer objects
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
    public function findOneBySomeField($value): ?EterStreamer
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
