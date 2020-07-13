<?php

namespace App\Repository;

use App\Entity\EtudiantLoge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtudiantLoge|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantLoge|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantLoge[]    findAll()
 * @method EtudiantLoge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantLogeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantLoge::class);
    }

    // /**
    //  * @return EtudiantLoge[] Returns an array of EtudiantLoge objects
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
    public function findOneBySomeField($value): ?EtudiantLoge
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
