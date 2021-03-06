<?php

namespace App\Repository;

use App\Entity\EterContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterContent[]    findAll()
 * @method EterContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterContent::class);
    }

    // /**
    //  * @return EterContent[] Returns an array of EterContent objects
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
    public function findOneBySomeField($value): ?EterContent
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
