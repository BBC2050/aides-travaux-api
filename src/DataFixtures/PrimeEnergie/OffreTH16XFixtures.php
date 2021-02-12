<?php

namespace App\DataFixtures\PrimeEnergie;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;

class OffreTH16XFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Isolation d\'un réseau hydraulique de chauffage ou d\'eau chaude sanitaire',
            'FICHE' => 'BAR-TH-160',
            'URL' => 'https://atee.fr/system/files/2019-12/BAR-TH-160%20v%20A27-1%20%C3%A0%20compter%20du%2001-04-2018.pdf',
            'OUVRAGES' => [ 'ENV_05' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est un immeuble collectif achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le bâtiment un système de chauffage collectif',
                    'EXPRESSIONS' => [ '$CODE_TYPE_CHAUFFAGE = "COLLECTIF"' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"' ]
                        ]
                    ],
                    'EXPRESSION' => '$LONGUEUR_RESEAU * 6700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$LONGUEUR_RESEAU * 5600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$LONGUEUR_RESEAU * 4900'
                ]
            ],
            'VARIABLES' => [
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'CODE_DEPARTEMENT',
                'LONGUEUR_RESEAU'
            ]
        ], [
            'NOM' => 'Système énergétique comportant des capteurs solaires photovoltaïques et thermiques à circulation d\'eau (France métropolitaine) ',
            'FICHE' => 'BAR-TH-162',
            'URL' => 'https://atee.fr/system/files/2019-12/BAR-TH-162.pdf',
            'OUVRAGES' => [ 'TH_34' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle achevée depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le logement est situé en France métropolitaine',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = true' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '20900'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Conduit d\'évacuation des produits de combustion',
            'FICHE' => 'BAR-TH-163',
            'URL' => 'https://atee.fr/system/files/2019-12/BAR-TH-163.pdff',
            'OUVRAGES' => [ 'DIV_02' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est un immeuble collectif achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Chaque logement dispose d\'un système de chauffage individuel au gaz',
                    'EXPRESSIONS' => [ '$CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ENERGIE_CHAUFFAGE = "GAZ"' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_CHAUDIERES * 37600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_CHAUDIERES * 32300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_CHAUDIERES * 24600'
                ]
            ],
            'VARIABLES' => [
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'CODE_DEPARTEMENT',
                'NOMBRE_CHAUDIERES'
            ]
        ], [
            'NOM' => 'Rénovation globale d\'une maison individuelle (France métropolitaine)',
            'FICHE' => 'BAR-TH-164',
            'URL' => 'https://atee.fr/system/files/2019-12/BAR-TH-164.pdf',
            'OUVRAGES' => [ 'DIV_04' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle achevée depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le logement est situé en France métropolitaine',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = true' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '($CEF_INITIAL - $CEF_PROJET) * $SURFACE_HABITABLE * 18'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CEF_INITIAL',
                'CEF_PROJET',
                'SURFACE_HABITABLE'
            ]
        ], [
            'NOM' => 'Chaudière biomasse collective',
            'FICHE' => 'BAR-TH-165',
            'URL' => 'https://atee.fr/system/files/2020-08/BAR-TH-165_FS%26AH_Chaudi%C3%A8re%20biomasse%20collective_0.pdf',
            'OUVRAGES' => [ 'TH_09', 'TH_10', 'TH_11' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est un immeuble collectif achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le bâtiment utilise un système de chauffage collectif',
                    'EXPRESSIONS' => [ '$CODE_TYPE_CHAUFFAGE = "COLLECTIF"' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Pour une chaudière de puissance inférieure ou égale à 500 kW',
                            'EXPRESSIONS' => [ '$PUISSANCE_CHAUDIERE <= 500' ]
                        ]
                    ],
                    'EXPRESSION' => '$CHALEUR_NETTE_UTILE * 4.8'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Pour une chaudière de puissance supérieure à 500 kW',
                            'EXPRESSIONS' => [ '$PUISSANCE_CHAUDIERE > 500' ]
                        ]
                    ],
                    'EXPRESSION' => '$CHALEUR_NETTE_UTILE * 3.4'
                ]
            ],
            'VARIABLES' => [
                'CODE_TYPE_CHAUFFAGE',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'PUISSANCE_CHAUDIERE',
                'CHALEUR_NETTE_UTILE'
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
