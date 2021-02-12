<?php

namespace App\DataFixtures\PrimeEnergie;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;

class OffreENVFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Isolation de combles ou de toitures',
            'FICHE' => 'BAR-EN-101',
            'URL' => 'https://atee.fr/system/files/2020-09/BAR-EN-101_FS%26AH_Isolation%20de%20combles%20ou%20de%20toitures%20v35.pdf',
            'OUVRAGES' => [ 'ENV_10', 'ENV_11', 'ENV_12' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le logement est situé en France métropolitaine',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = true' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 900'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_DEPARTEMENT',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Isolation des murs',
            'FICHE' => 'BAR-EN-102',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-en-102_0.pdf',
            'OUVRAGES' => [ 'ENV_06', 'ENV_07' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le logement est situé en France métropolitaine',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = true' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 2400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 2000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 3800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 3100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 2100'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_DEPARTEMENT',
                'CODE_ENERGIE_CHAUFFAGE',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Isolation d\'un plancher',
            'FICHE' => 'BAR-EN-103',
            'URL' => 'https://atee.fr/system/files/2020-10/BAR-EN-103_FS%26AH_Isolation%20d%27un%20plancher%20v36_0.pdf',
            'OUVRAGES' => [ 'ENV_08', 'ENV_09' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le plancher bas est situé entre un volume chauffé et un sous-sol non chauffé, un vide sanitaire ou un passage ouvert',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 900'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Fenêtre ou porte-fenêtre complète avec vitrage isolant',
            'FICHE' => 'BAR-EN-102',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-en-104_0.pdf',
            'OUVRAGES' => [ 'ENV_01' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 5200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 4200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 2800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 8200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 6700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 4500'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_ENERGIE_CHAUFFAGE',
                'NOMBRE_EQUIPEMENTS'
            ]
        ], [
            'NOM' => 'Isolation des toitures terrasses',
            'FICHE' => 'BAR-EN-105',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-en-105_0.pdf',
            'OUVRAGES' => [ 'ENV_13' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 2200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 1200'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_ENERGIE_CHAUFFAGE',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Isolation de combles ou de toitures (France d\'outre-mer)',
            'FICHE' => 'BAR-EN-106',
            'URL' => 'https://atee.fr/system/files/2020-09/BAR-EN-106_FS%26AH_Isolation%20de%20combles%20ou%20de%20toitures%20v35.pdf',
            'OUVRAGES' => [ 'ENV_10', 'ENV_11', 'ENV_12' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est situé dans un département d\'outre-mer',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = false' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - Logement existant',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 320'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - Logement neuf',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT < 2']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 210'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - Logement existant',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 380'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - Logement neuf',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT < 2']
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 250'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Isolation des murs (France d\'outre-mer)',
            'FICHE' => 'BAR-EN-107',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-en-107_mod_a20-3_0.pdf',
            'OUVRAGES' => [ 'ENV_06', 'ENV_07' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est situé dans un département d\'outre-mer',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = false' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - Bâtiment existant - 0,5 ≤ R < 1,2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2 && $RESISTANCE_ISOLANT >= 0.5 && $RESISTANCE_ISOLANT < 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - Bâtiment existant - 1,2 ≤ R',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2 && $RESISTANCE_ISOLANT > 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 240'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - Bâtiment neuf - 0,5 ≤ R < 1,2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT < 2 && $RESISTANCE_ISOLANT >= 0.5 && $RESISTANCE_ISOLANT < 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 130'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - Bâtiment neuf - 1,2 ≤ R',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT < 2 && $RESISTANCE_ISOLANT > 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 150'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - Bâtiment existant - 0,5 ≤ R < 1,2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2 && $RESISTANCE_ISOLANT >= 0.5 && $RESISTANCE_ISOLANT < 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 240'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - Bâtiment existant - 1,2 ≤ R',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2 && $RESISTANCE_ISOLANT > 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 280'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - Bâtiment neuf - 0,5 ≤ R < 1,2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT < 2 && $RESISTANCE_ISOLANT >= 0.5 && $RESISTANCE_ISOLANT < 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 160'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - Bâtiment neuf - 1,2 ≤ R',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT < 2 && $RESISTANCE_ISOLANT > 1.2'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 180'
                ], 
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'SURFACE_ISOLANT',
                'RESISTANCE_ISOLANT'
            ]
        ], [
            'NOM' => 'Fermeture isolante',
            'FICHE' => 'BAR-EN-108',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-en-108_0.pdf',
            'OUVRAGES' => [ 'ENV_03' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 660'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Electricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 440'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H1 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H2 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Zone climatique H3 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"']
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 690'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_ENERGIE_CHAUFFAGE',
                'NOMBRE_EQUIPEMENTS'
            ]
        ], [
            'NOM' => 'Réduction des apports solaires par la toiture (France d\'outre-mer) ',
            'FICHE' => 'BAR-EN-109',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-en-109_1.pdf',
            'OUVRAGES' => [ 'ENV_14' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le bâtiment est situé dans un département d\'outre-mer',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = false' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_PROTEGEE * 400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif ',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_PROTEGEE * 520'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'SURFACE_PROTEGEE'
            ]
        ], [
            'NOM' => 'Fenêtre ou porte-fenêtre complète avec vitrage pariétodynamique',
            'FICHE' => 'BAR-EN-110',
            'URL' => 'https://atee.fr/system/files/2020-08/BAR-EN-110%20v%20A35-1.pdf',
            'OUVRAGES' => [ 'ENV_02' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
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
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 7100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 6000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 4200'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'AGE_LOGEMENT',
                'NOMBRE_EQUIPEMENTS'
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

