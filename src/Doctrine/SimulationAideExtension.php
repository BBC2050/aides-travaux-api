<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Aide;

final class SimulationAideExtension implements QueryItemExtensionInterface
{
    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = []): void
    {
        if ( $context['request_uri'] === '/simulations' && $resourceClass === Aide::class ) {
            $this->addWhere($queryBuilder, $resourceClass, $identifiers);
        }
    }

    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass, array $identifiers): void
    {
        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder
            ->leftJoin( \sprintf('%s.distributeur', $rootAlias), 'distributeur')
            ->addSelect('distributeur')
            ->leftJoin( \sprintf('%s.conditions', $rootAlias), 'conditions')
            ->addSelect('conditions')
            ->leftJoin( \sprintf('%s.valeurs', $rootAlias), 'valeurs')
            ->addSelect('valeurs')
            ->leftJoin( 'valeurs.conditions', 'valeursConditions')
            ->addSelect('valeursConditions');
    }

}
