<?php

namespace App\Repository;

use App\Entity\Dispositif;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method Dispositif|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dispositif|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dispositif[]    findAll()
 * @method Dispositif[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DispositifRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dispositif::class);
    }

    public function findAllAvailable(int $secteur, array $dispositifs, array $zones)
    {
        return $this->createQueryBuilder('d')
            ->leftJoin('d.distributeur', 'distributeur')
            ->addSelect('distributeur')
            ->leftJoin('d.logo', 'logo')
            ->addSelect('logo')
            ->leftJoin('d.zones', 'zones')
            ->addSelect('zones')
            ->leftJoin('d.conditions', 'conditions')
            ->addSelect('conditions')
            ->leftJoin('conditions.expression', 'conditionsExpression')
            ->addSelect('conditionsExpression')
            ->leftJoin('d.valeurs', 'valeurs')
            ->addSelect('valeurs')
            ->leftJoin('valeurs.expression', 'valeursExpression')
            ->addSelect('valeursExpression')
            ->leftJoin('valeurs.condition', 'valeursCondition')
            ->addSelect('valeursCondition')
            ->leftJoin('d.exclusions', 'exclusions')
            ->addSelect('exclusions')
            ->andWhere('d.secteur = :secteur')
            ->andWhere('zones.id IS NULL OR zones.code IN(:zones)')
            ->andWhere('d.active = 1')
            ->andWhere('d.dateDebut <= :now')
            ->andWhere('d.dateFin IS NULL OR d.dateFin > :now')
            ->andWhere('d.id IN(:dispositifs)')
            ->setParameter('secteur', $secteur)
            ->setParameter('zones', $zones)
            ->setParameter('dispositifs', $dispositifs)
            ->setParameter('now', (new \DateTime())->format('Y-m-d'))
            ->getQuery()
            ->getResult();
    }

}
