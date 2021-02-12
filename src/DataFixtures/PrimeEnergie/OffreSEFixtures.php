<?php

namespace App\DataFixtures\PrimeEnergie;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;

class OffreSEFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Réglage des organes d’équilibrage d’une installation de chauffage à eau chaude',
            'FICHE' => 'BAR-SE-104',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-se-104_0.pdf',
            'OUVRAGES' => [ 'TH_25' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est un appartement achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 9800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 8000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 5300'
                ]
            ],
            'VARIABLES' => [
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_DEPARTEMENT',
                'NOMBRE_LOGEMENTS'
            ]
        ], [
            'NOM' => 'Contrat de Performance Energétique Services (CPE Services) ',
            'FICHE' => 'BAR-SE-105',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-se-105_0.pdf',
            'OUVRAGES' => [ 'SE_03' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est un bâtiment collectif',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF"' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 2 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 2']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 2400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 3 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 3']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 3500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 4 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 4']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 4600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 5 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 5']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 5600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 6 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 6']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 6600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 7 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 7']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 7600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 8 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 8']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 8500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 9 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE = 9']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 9400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - 10 ans et plus',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $DUREE_GARANTIE >= 10']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 10200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 2 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 2']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 2000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 3 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 3']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 2900'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 4 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 4']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 3800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 5 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 5']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 4700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 6 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 6']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 5500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 7 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 7']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 6300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 8 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 8']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 7100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 9 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE = 9']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 7800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - 10 ans et plus',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $DUREE_GARANTIE >= 10']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 8500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 2 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 2']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 1500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 3 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 3']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 2200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 4 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 4']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 2800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 5 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 5']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 3400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 6 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 6']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 4100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 7 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 7']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 4700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 8 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 8']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 5200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 9 ans',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE = 9']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 5800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - 10 ans et plus',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $DUREE_GARANTIE >= 10']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 6300'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'DUREE_GARANTIE',
                'NOMBRE_LOGEMENTS'
            ]
        ], [
            'NOM' => 'Service de suivi des consommations d’énergie',
            'FICHE' => 'BAR-SE-106',
            'URL' => 'https://atee.fr/system/files/2020-01/BAR-SE-106%20Service%20de%20suivi%20des%20consommations%20d%27%C3%A9nergie.pdf',
            'OUVRAGES' => [ 'SE_05' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1 - Chauffage électrique',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1" && CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1 - Chauffage gaz',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1" && CODE_ENERGIE_CHAUFFAGE = "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '620'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1 - Chauffage autre',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1" && CODE_ENERGIE_CHAUFFAGE <> "ELEC" && CODE_ENERGIE_CHAUFFAGE <> "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '90'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2 - Chauffage électrique',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2" && CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '340'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2 - Chauffage gaz',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2" && CODE_ENERGIE_CHAUFFAGE = "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '510'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2 - Chauffage autre',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2" && CODE_ENERGIE_CHAUFFAGE <> "ELEC" && CODE_ENERGIE_CHAUFFAGE <> "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '90'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3 - Chauffage électrique',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3" && CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '250'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3 - Chauffage gaz',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3" && CODE_ENERGIE_CHAUFFAGE = "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '380'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3 - Chauffage autre',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3" && CODE_ENERGIE_CHAUFFAGE <> "ELEC" && CODE_ENERGIE_CHAUFFAGE <> "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '90'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H1 - Chauffage électrique',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H1" && CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '160'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H1 - Chauffage gaz',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H1" && CODE_ENERGIE_CHAUFFAGE = "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '340'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H1 - Chauffage autre',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H1" && CODE_ENERGIE_CHAUFFAGE <> "ELEC" && CODE_ENERGIE_CHAUFFAGE <> "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '60'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H2 - Chauffage électrique',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H2" && CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '140'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H2 - Chauffage gaz',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H2" && CODE_ENERGIE_CHAUFFAGE = "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '290'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H2 - Chauffage autre',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H2" && CODE_ENERGIE_CHAUFFAGE <> "ELEC" && CODE_ENERGIE_CHAUFFAGE <> "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '60'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H3 - Chauffage électrique',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H3" && CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '110'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H3 - Chauffage gaz',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H3" && CODE_ENERGIE_CHAUFFAGE = "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '220'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H3 - Chauffage autre',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H3" && CODE_ENERGIE_CHAUFFAGE <> "ELEC" && CODE_ENERGIE_CHAUFFAGE <> "GAZ"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '60'
                ]
            ],
            'VARIABLES' => [
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_DEPARTEMENT',
                'CODE_ENERGIE_CHAUFFAGE'
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
