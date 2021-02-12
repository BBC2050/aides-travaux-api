<?php

namespace App\DataFixtures\MaPrimeRenovRose;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;

class OffreFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Rénovation globale',
            'OUVRAGES' => [ 'DIV_04' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '3500'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Isolation des murs par l\'extérieur',
            'OUVRAGES' => [ 'ENV_06' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 15'
                ]
            ],
            'VARIABLES' => [ 'SURFACE_ISOLANT' ]
        ], [
            'NOM' => 'Isolation des toitures terrasses',
            'OUVRAGES' => [ 'ENV_13' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 15'
                ]
            ],
            'VARIABLES' => [ 'SURFACE_ISOLANT' ]
        ], [
            'NOM' => 'Isolation des murs par l\'intérieur',
            'OUVRAGES' => [ 'ENV_07' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 7'
                ]
            ],
            'VARIABLES' => [ 'SURFACE_ISOLANT' ]
        ], [
            'NOM' => 'Isolation des rampants de toiture et plafonds de combles',
            'OUVRAGES' => [ 'ENV_11', 'ENV_12' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 7'
                ]
            ],
            'VARIABLES' => [ 'SURFACE_ISOLANT' ]
        ]
    ];

    public function getAide(): string
    {
        return AideFixtures::AIDE['CODE'];
    }

    public function getData(): array
    {
        return self::OFFRES;
    }

    public function getDependencies()
    {
        return [ AideFixtures::class, OuvrageFixtures::class ];
    }
}

