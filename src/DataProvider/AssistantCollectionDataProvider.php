<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Services\Assistant;

final class AssistantCollectionDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Assistant::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null): \Generator
    {
        foreach (Assistant::HELPERS as $key => $helper) {
            yield [ 'nom' => $key, 'description' => $helper['description'] ];
        }
    }
}
