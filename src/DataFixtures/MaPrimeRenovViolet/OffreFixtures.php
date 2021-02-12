<?php

namespace App\DataFixtures\MaPrimeRenovViolet;

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
                    'EXPRESSION' => '7000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Audit énergétique',
            'OUVRAGES' => [ 'SE_02' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '300'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Chaudières à granulés',
            'OUVRAGES' => [ 'TH_10' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '4000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Pompes à chaleur géothermiques ou solarothermiques',
            'OUVRAGES' => [ 'TH_22', 'TH_24' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '4000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Chauffage solaire',
            'OUVRAGES' => [ 'TH_33' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '4000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Chaudières à bûches',
            'OUVRAGES' => [ 'TH_09' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '3000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Pompes à chaleur air/ eau',
            'OUVRAGES' => [ 'TH_20', 'TH_23' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Chauffe-eau solaire',
            'OUVRAGES' => [ 'TH_32' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Poêles à granulés',
            'OUVRAGES' => [ 'TH_17' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '1500'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Poêles à bûches',
            'OUVRAGES' => [ 'TH_16' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '1000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Foyers fermés, inserts',
            'OUVRAGES' => [ 'TH_14', 'TH_15' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '600'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Équipements solaires hybrides',
            'OUVRAGES' => [ 'TH_34' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '1000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Réseaux de chaleur ou de froid',
            'OUVRAGES' => [ 'TH_05', 'TH_06' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '400'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Chauffe-eau thermodynamique',
            'OUVRAGES' => [ 'TH_18' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '400'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Dépose d\'une cuve à fioul',
            'OUVRAGES' => [ 'SE_04' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '400'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Ventilation mécanique contrôlée (VMC) double flux',
            'OUVRAGES' => [ 'TH_36' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2000'
                ]
            ],
            'VARIABLES' => []
        ], [
            'NOM' => 'Isolation thermique des fenêtres (et parois vitrées)',
            'OUVRAGES' => [ 'ENV_01' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 40'
                ]
            ],
            'VARIABLES' => [ 'NOMBRE_EQUIPEMENTS' ]
        ], [
            'NOM' => 'Isolation des murs par l\'extérieur',
            'OUVRAGES' => [ 'ENV_06' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 40'
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
                    'EXPRESSION' => '$SURFACE_ISOLANT * 40'
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
                    'EXPRESSION' => '$SURFACE_ISOLANT * 15'
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
                    'EXPRESSION' => '$SURFACE_ISOLANT * 15'
                ]
            ],
            'VARIABLES' => [ 'SURFACE_ISOLANT' ]
        ], [
            'NOM' => 'Protections contre le rayonnement solaire',
            'OUVRAGES' => [ 'ENV_14', 'ENV_15' ],
            'CONDITIONS' => [],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime forfaitaire',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Le logement est situé dans un département d\'outre-mer',
                            'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = false' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_PROTEGEE * 15'
                ]
            ],
            'VARIABLES' => [ 'CODE_REGION', 'SURFACE_PROTEGEE' ]
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

