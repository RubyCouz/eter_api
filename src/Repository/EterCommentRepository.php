<?php

namespace App\Repository;

use App\Entity\EterComment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterComment|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterComment|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterComment[]    findAll()
 * @method EterComment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterCommentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterComment::class);
    }

    // /**
    //  * @return EterComment[] Returns an array of EterComment objects
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
    public function findOneBySomeField($value): ?EterComment
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
