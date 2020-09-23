<?php

namespace App\Repository;

use App\Entity\Variable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method Variable|null find($id, $lockMode = null, $lockVersion = null)
 * @method Variable|null findOneBy(array $criteria, array $orderBy = null)
 * @method Variable[]    findAll()
 * @method Variable[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VariableRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Variable::class);
    }

    public function findByAidesAndOuvrage(int $ouvrage, array $aides): array
    {
        return $this->createQueryBuilder('v')
            ->innerJoin('v.offres', 'offres', Expr\Join::WITH, 'offres.aide IN (:aides) AND offres.ouvrage = :ouvrage')
            ->setParameter('aides', $aides)
            ->setParameter('ouvrage', $ouvrage)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Variable[] Returns an array of Variable objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Variable
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
