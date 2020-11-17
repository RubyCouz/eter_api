<?php

namespace App\Repository;

use App\Entity\EterProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EterProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterProduct[]    findAll()
 * @method EterProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterProduct::class);
    }

    // /**
    //  * @return EterProduct[] Returns an array of EterProduct objects
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
    public function findOneBySomeField($value): ?EterProduct
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
