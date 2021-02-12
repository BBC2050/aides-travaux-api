<?php

namespace App\DataFixtures\PrimeEnergie;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;

class OffreTH11XFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Radiateur basse température pour un chauffage central',
            'FICHE' => 'BAR-TH-110',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-110_0.pdf',
            'OUVRAGES' => [ 'TH_08' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
                ], [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                // Maison individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 910'
                ],
                // Montant - Appartement avec chauffage individuel
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 880'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 850'
                ],
                // Montant - Appartement avec chauffage collectif
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 850'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 560'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'NOMBRE_EQUIPEMENTS'
            ]
        ], [
            'NOM' => 'Régulation par sonde de température extérieure',
            'FICHE' => 'BAR-TH-111',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-111_0.pdf',
            'OUVRAGES' => [ 'TH_26' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle achevée depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                // Montant
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - Électricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"' ]
                        ]
                    ],
                    'EXPRESSION' => '2200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H1 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"' ]
                        ]
                    ],
                    'EXPRESSION' => '3300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - Électricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"' ]
                        ]
                    ],
                    'EXPRESSION' => '1800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"' ]
                        ]
                    ],
                    'EXPRESSION' => '2700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - Électricité',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"' ]
                        ]
                    ],
                    'EXPRESSION' => '1200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3 - Autres',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"' ]
                        ]
                    ],
                    'EXPRESSION' => '1800'
                ], 
                // Facteur correctif
                [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'S < 35',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE < 35' ]
                        ]
                    ],
                    'EXPRESSION' => '0.3'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '35 ≤ S < 60',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE >= 35 && $SURFACE_HABITABLE < 60' ]
                        ]
                    ],
                    'EXPRESSION' => '0.5'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '60 ≤ S < 70',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE >= 60 && $SURFACE_HABITABLE < 70' ]
                        ]
                    ],
                    'EXPRESSION' => '0.6'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '70 ≤ S < 90',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE >= 70" && $SURFACE_HABITABLE < 90' ]
                        ]
                    ],
                    'EXPRESSION' => '0.7'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '90 ≤ S < 110',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE >= 90 && $SURFACE_HABITABLE < 110' ]
                        ]
                    ],
                    'EXPRESSION' => '1'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '110 ≤ S < 130',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE >= 110 && $SURFACE_HABITABLE < 130' ]
                        ]
                    ],
                    'EXPRESSION' => '1.1'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '130 < S',
                            'EXPRESSIONS' => [ '$SURFACE_HABITABLE > 130' ]
                        ]
                    ],
                    'EXPRESSION' => '1.6'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_ENERGIE_CHAUFFAGE',
                'SURFACE_HABITABLE'
            ]
        ], [
            'NOM' => 'Appareil indépendant de chauffage au bois',
            'FICHE' => 'BAR-TH-112',
            'URL' => 'https://atee.fr/system/files/2020-08/BAR-TH-112%20v%20A35-2%20%C3%A0%20compter%20du%2001-10-2020.pdf',
            'OUVRAGES' => [ 'TH_12', 'TH_13', 'TH_14', 'TH_15', 'TH_16', 'TH_17' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle achevée depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2' ]
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
                    'EXPRESSION' => '38200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '31300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '20900'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Chaudière biomasse individuelle',
            'FICHE' => 'BAR-TH-113',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-113_0.pdf',
            'OUVRAGES' => [ 'TH_09', 'TH_10', 'TH_11' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle achevée depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2' ]
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
                    'EXPRESSION' => '142300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '116400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '77600'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Plancher chauffant hydraulique à basse température',
            'FICHE' => 'BAR-TH-116',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-116_0.pdf',
            'OUVRAGES' => [ 'TH_04' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
                ], [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                // Maison individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 250'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 160'
                ],
                // Montant - Appartement avec chauffage individuel
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 210'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 170'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 110'
                ],
                // Montant - Appartement avec chauffage collectif
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 280'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 230'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CHAUFFEE * 150'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'SURFACE_CHAUFFEE'
            ]
        ], [
            'NOM' => 'Robinet thermostatique',
            'FICHE' => 'BAR-TH-117',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-117_0.pdf',
            'OUVRAGES' => [ 'TH_27' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
                ], [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                // Maison individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 930'
                ],
                // Montant - Appartement avec chauffage individuel
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 980'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage individuel - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 650'
                ],
                // Montant - Appartement avec chauffage collectif
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 1300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - Chauffage collectif - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 890'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'NOMBRE_EQUIPEMENTS'
            ]
        ], [
            'NOM' => 'Système de régulation par programmation d’intermittence',
            'FICHE' => 'BAR-TH-118',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-118_0.pdf',
            'OUVRAGES' => [ 'TH_29' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                // Maison individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1 - Électricité',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '11600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1 - Autres',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '14200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2 - Électricité',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '9500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2 - Autres',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '11600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3 - Électricité',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '6300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3 - Autres',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '7700'
                ],
                // Montant - Appartement - Chauffage individuel
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H1 - Électricité',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '4300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H1 - Autres',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H1" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '6600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H2 - Électricité',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '3500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H2 - Autres',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H2" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '5400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H3 - Électricité',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE = "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '2300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H3 - Autres',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ZONE_CLIMATIQUE = "H3" && $CODE_ENERGIE_CHAUFFAGE <> "ELEC"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '3600'
                ],
                // Montant - Bâtiment collectif
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 9100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 7400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Bâtiment collectif - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $CODE_TYPE_CHAUFFAGE = "COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 4900'
                ],
                // Facteur correctif - Maison individuelle
                [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'S < 35',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE < 35'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.3'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '35 ≤ S < 60',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 35 && $SURFACE_CHAUFFEE < 60'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.5'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '60 ≤ S < 70',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 60 && $SURFACE_CHAUFFEE < 70'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.6'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '70 ≤ S < 90',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 70" && $SURFACE_CHAUFFEE < 90'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.7'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '90 ≤ S < 110',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 90" && $SURFACE_CHAUFFEE < 110'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '110 ≤ S < 130',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 110" && $SURFACE_CHAUFFEE < 130'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1.1'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '130 < S',
                            'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE > 130' ]
                        ]
                    ],
                    'EXPRESSION' => '1.6'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'NOMBRE_LOGEMENTS',
                'SURFACE_CHAUFFEE'
            ]
        ], 
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
