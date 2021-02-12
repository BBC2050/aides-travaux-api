<?php

namespace App\DataFixtures\EcoPTZ;

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
            'NOM' => 'Équipements de chauffage utilisant une source d’énergie renouvelable',
            'OUVRAGES' => [
                'TH_09', 'TH_10', 'TH_11', 'TH_12', 'TH_13', 'TH_14', 'TH_15', 'TH_16', 'TH_17', 'TH_33'
            ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
        ], [
            'NOM' => 'Équipements de production d’eau chaude sanitaire utilisant une source d’énergie renouvelable',
            'OUVRAGES' => [ 'TH_32', 'TH_18' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
        ], [
            'NOM' => 'Isolation thermique performante de la toiture',
            'OUVRAGES' => [ 'ENV_10', 'ENV_11', 'ENV_12', 'ENV_13' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Isolation de l\'intégralité de la toiture',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
        ], [
            'NOM' => 'Isolation thermique performante des murs',
            'OUVRAGES' => [ 'ENV_06', 'ENV_07' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Isolation de d\'au moins la moitié des murs donnant sur l\'extérieur',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
        ], [
            'NOM' => 'Isolation thermique performante des parois vitrées',
            'OUVRAGES' => [ 'ENV_01' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Remplacement d\'au moins la moitié des fenêtres et portes-fenêtres simple vitrage',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
        ], [
            'NOM' => 'Isolation thermique performante des planchers bas',
            'OUVRAGES' => [ 'ENV_08', 'ENV_09' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Les planchers donnent sur un sous-sol, un vide sanitaire, ou un passage ouvert',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
        ], [
            'NOM' => 'Systèmes de chauffage ou de production d’eau chaude sanitaire',
            'OUVRAGES' => [ 'TH_02', 'TH_05', 'TH_20', 'TH_21', 'TH_22' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Dépenses éligibles',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_TTC'
                ]
            ],
            'VARIABLES' => [
                'COUT_TTC'
            ]
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

