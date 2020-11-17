<?php

namespace App\Repository;

use App\Entity\EterLabel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterLabel|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterLabel|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterLabel[]    findAll()
 * @method EterLabel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterLabelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterLabel::class);
    }

    // /**
    //  * @return EterLabel[] Returns an array of EterLabel objects
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
    public function findOneBySomeField($value): ?EterLabel
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
