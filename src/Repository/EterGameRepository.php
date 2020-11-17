<?php

namespace App\Repository;

use App\Entity\EterGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DBALException;

/**
 * @method EterGame|null find($id, $lockMode = null, $lockVersion = null)
 * @method EterGame|null findOneBy(array $criteria, array $orderBy = null)
 * @method EterGame[]    findAll()
 * @method EterGame[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EterGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EterGame::class);
    }

    public function getRandGame() {
        try{
        $conn = $this->getEntityManager()->getConnection();
        $query = '
        SELECT SQL_NO_CACHE *
        FROM `eter_game`
        ORDER BY RAND( )
        LIMIT 4
        ';
            $stmt = $conn->prepare($query);
            $stmt ->execute();
            return $stmt->fetchAll();
        } catch(DBALException $e) {
        }

    }
    // /**
    //  * @return EterGame[] Returns an array of EterGame objects
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
    public function findOneBySomeField($value): ?EterGame
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
