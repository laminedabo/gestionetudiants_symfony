<?php

namespace App\Repository;

use App\Entity\EtudiantNonBoursier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtudiantNonBoursier|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantNonBoursier|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantNonBoursier[]    findAll()
 * @method EtudiantNonBoursier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantNonBoursierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantNonBoursier::class);
    }

    // /**
    //  * @return EtudiantNonBoursier[] Returns an array of EtudiantNonBoursier objects
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
    public function findOneBySomeField($value): ?EtudiantNonBoursier
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
