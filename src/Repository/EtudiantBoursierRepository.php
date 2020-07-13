<?php

namespace App\Repository;

use App\Entity\EtudiantBoursier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtudiantBoursier|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtudiantBoursier|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtudiantBoursier[]    findAll()
 * @method EtudiantBoursier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudiantBoursierRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtudiantBoursier::class);
    }

    // /**
    //  * @return EtudiantBoursier[] Returns an array of EtudiantBoursier objects
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
    public function findOneBySomeField($value): ?EtudiantBoursier
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
