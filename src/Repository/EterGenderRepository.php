<?php

namespace App\Repository;

use App\Entity\EterGender;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterGender|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterGender|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterGender[]    findAll()
 * @method EterGender[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterGenderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterGender::class);
    }

    // /**
    //  * @return EterGender[] Returns an array of EterGender objects
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
    public function findOneBySomeField($value): ?EterGender
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
