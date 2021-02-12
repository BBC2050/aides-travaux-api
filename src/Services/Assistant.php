<?php

namespace App\Services;

use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ApiResource(
 *      attributes={
 *          "pagination_enabled"=false
 *      },
 *      itemOperations={},
 *      collectionOperations={
 *          "get"={
 *              "security"="is_granted('ROLE_ADMIN')"
 *          }
 *      }
 * )
 */
abstract class Assistant
{
    /**
     * @var array
     */
    public const HELPERS = [
        'FRANCE_METROPOLITAINE' => [
            'description' => 'France métropolitaine',
            'method' => 'isFranceMetropolitaine'
        ],
        'CODE_ZONE_CLIMATIQUE' => [
            'description' => 'Zone climatique',
            'method' => 'getZoneClimatique'
        ],
        'TRAVAUX_ELIGIBLES' => [
            'description' => 'Nombre de travaux éligibles',
            'method' => 'getTravauxEligibles'
        ],
        'RESTE_A_CHARGE' => [
            'description' => 'Reste à charge après déduction des primes',
            'method' => 'getResteACharge'
        ]
    ];
}
