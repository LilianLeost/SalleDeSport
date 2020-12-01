<?php

namespace App\Repository;

use App\Entity\Rubriques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rubriques|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rubriques|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rubriques[]    findAll()
 * @method Rubriques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RubriquesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rubriques::class);
    }

    // /**
    //  * @return Rubriques[] Returns an array of Rubriques objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rubriques
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
