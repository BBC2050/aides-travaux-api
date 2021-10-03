<?php

namespace App\Repository;

use App\Entity\Action;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr;

/**
 * @method Action|null find($id, $lockMode = null, $lockVersion = null)
 * @method Action|null findOneBy(array $criteria, array $orderBy = null)
 * @method Action[]    findAll()
 * @method Action[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Action::class);
    }

    public function findAllAvailable(?int $secteur, array $actions)
    {
        return $this->createQueryBuilder('a')
            ->innerJoin('a.categorie', 'categorie')
            ->addSelect('categorie')
            ->leftJoin('categorie.secteur', 'secteur')
            ->addSelect('secteur')
            ->andWhere('secteur.id = :secteur')
            ->andWhere('a.id IN(:actions)')
            ->setParameter('secteur', $secteur)
            ->setParameter('actions', $actions)
            ->getQuery()
            ->getResult();
    }

}
