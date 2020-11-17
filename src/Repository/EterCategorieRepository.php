<?php

namespace App\Repository;

use App\Entity\EterCategorie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EterCategorie|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterCategorie|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterCategorie[]    findAll()
 * @method EterCategorie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterCategorieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterCategorie::class);
    }

    // /**
    //  * @return EterCategorie[] Returns an array of EterCategorie objects
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
    public function findOneBySomeField($value): ?EterCategorie
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
