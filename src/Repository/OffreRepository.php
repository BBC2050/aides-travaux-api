<?php

namespace App\Repository;

use App\Entity\Offre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method Offre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Offre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Offre[]    findAll()
 * @method Offre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Offre::class);
    }

    public function findByOuvragesAndAides(array $ouvrages, array $aides)
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.aide', 'aide', Expr\Join::WITH, 'aide.id IN (:aides)')
            ->addSelect('aide')
            ->innerJoin('o.ouvrages', 'ouvrages', Expr\Join::WITH, 'ouvrages.id IN (:ouvrages)')
            ->addSelect('ouvrages')
            ->leftJoin('o.conditions', 'conditions')
            ->addSelect('conditions')
            ->leftJoin('conditions.expressions', 'conditionsExpressions')
            ->addSelect('conditionsExpressions')
            ->leftJoin('o.valeurs', 'valeurs')
            ->addSelect('valeurs')
            ->leftJoin('valeurs.expression', 'valeursExpression')
            ->addSelect('valeursExpression')
            ->leftJoin('valeurs.conditions', 'valeursConditions')
            ->addSelect('valeursConditions')
            ->leftJoin('valeursConditions.expressions', 'valeursConditionsExpressions')
            ->addSelect('valeursConditionsExpressions')
            ->andWhere('o.active = 1')
            ->setParameter('ouvrages', $ouvrages)
            ->setParameter('aides', $aides)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Offre[] Returns an array of Offre objects
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
    public function findOneBySomeField($value): ?Offre
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
