<?php

namespace App\Repository;

use App\Entity\EterUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterUser[]    findAll()
 * @method EterUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterUser::class);
    }

    // /**
    //  * @return EterUser[] Returns an array of EterUser objects
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
    public function findOneBySomeField($value): ?EterUser
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
