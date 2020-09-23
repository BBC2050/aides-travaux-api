<?php

namespace App\Repository;

use App\Entity\Aide;
use App\Model\Simulation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Aide|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aide|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aide[]    findAll()
 * @method Aide[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AideRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aide::class);
    }

    public function findByPerimetreDistributeur(Simulation $simulation)
    {
        $perimetres = [
            $simulation->getCodeRegion(),
            $simulation->getCodeDepartement(),
            $simulation->getCodeCommune()
        ];
        if ( $simulation->isLocal() === false ) {
            $perimetres[] = 'FR';
        }
        
        return $this->createQueryBuilder('a')
            ->innerJoin('a.distributeur', 'distributeur')
            ->addSelect('distributeur')
            ->leftJoin('a.aidesCumulables', 'aidesCumulables')
            ->addSelect('aidesCumulables')
            ->leftJoin('a.conditions', 'conditions')
            ->addSelect('conditions')
            ->leftJoin('a.valeurs', 'valeurs')
            ->addSelect('valeurs')
            ->leftJoin('valeurs.conditions', 'valeursConditions')
            ->addSelect('valeursConditions')
            ->andWhere('distributeur.perimetre IN (:perimetres)')
            ->setParameter('perimetres', $perimetres)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Aide[] Returns an array of Aide objects
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
    public function findOneBySomeField($value): ?Aide
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
