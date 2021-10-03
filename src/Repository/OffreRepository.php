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

    public function findAllAvailable(array $dispositifs, array $actions, array $zones)
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.dispositif', 'dispositif', Expr\Join::WITH, 'dispositif.id IN (:dispositifs)')
            ->addSelect('dispositif')
            ->leftJoin('o.actions', 'actions')
            ->addSelect('actions')
            ->leftJoin('o.zones', 'zones')
            ->addSelect('zones')
            ->leftJoin('o.conditions', 'conditions')
            ->addSelect('conditions')
            ->leftJoin('conditions.expression', 'conditionsExpression')
            ->addSelect('conditionsExpression')
            ->leftJoin('o.valeurs', 'valeurs')
            ->addSelect('valeurs')
            ->leftJoin('valeurs.expression', 'valeursExpression')
            ->addSelect('valeursExpression')
            ->leftJoin('valeurs.condition', 'valeursCondition')
            ->addSelect('valeursCondition')
            ->leftJoin('o.exclusions', 'exclusions')
            ->addSelect('exclusions')
            ->andWhere('zones.id IS NULL OR zones.code IN(:zones)')
            ->andWhere('o.active = 1')
            ->andWhere('o.dateDebut <= :now')
            ->andWhere('o.dateFin IS NULL OR o.dateFin > :now')
            ->andWhere('o.actions IS EMPTY OR :actions MEMBER OF o.actions')
            ->setParameter('zones', $zones)
            ->setParameter('dispositifs', $dispositifs)
            ->setParameter('actions', $actions)
            ->setParameter('now', (new \DateTime())->format('Y-m-d'))
            ->getQuery()
            ->getResult();
    }

}
