<?php

namespace App\Repository;

use App\Entity\Ouvrage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method Ouvrage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ouvrage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ouvrage[]    findAll()
 * @method Ouvrage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OuvrageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ouvrage::class);
    }

    public function findOneByAides(int $id, array $aides): ?Ouvrage
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.offres', 'offres', Expr\Join::WITH, 'offres.aide IN (:aides)')
            ->addSelect('offres')
            ->innerJoin('offres.aide', 'offresAide')
            ->addSelect('offresAide')
            ->leftJoin('offres.conditions', 'conditions')
            ->addSelect('conditions')
            ->leftJoin('offres.valeurs', 'valeurs')
            ->addSelect('valeurs')
            ->leftJoin('valeurs.conditions', 'valeursConditions')
            ->addSelect('valeursConditions')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->setParameter('aides', $aides)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Ouvrage[] Returns an array of Ouvrage objects
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
    public function findOneBySomeField($value): ?Ouvrage
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
