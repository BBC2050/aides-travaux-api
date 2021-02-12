<?php

namespace App\DataFixtures\PrimeEnergie;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;

class OffreTH12XFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Système de comptage individuel d\'énergie de chauffage',
            'FICHE' => 'BAR-TH-121',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-121_mod_a27-2_a_compter_du_01-04-2018_1.pdf',
            'OUVRAGES' => [ 'TH_28' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est un appartement achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $AGE_LOGEMENT >= 2' ]
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 11500'
                ]
            ],
            'VARIABLES' => [
                'AGE_LOGEMENT',
                'CODE_TYPE_CHAUFFAGE',
                'NOMBRE_LOGEMENTS'
            ]
        ], [
            'NOM' => 'Optimiseur de relance en chauffage collectif',
            'FICHE' => 'BAR-TH-123',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-123_0.pdf',
            'OUVRAGES' => [ 'DIV_03' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est un appartement achevé depuis plus de deux ans',
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
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 12400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 10100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"' ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 6700'
                ]
            ],
            'VARIABLES' => [
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_DEPARTEMENT',
                'NOMBRE_LOGEMENTS'
            ]
        ], [
            'NOM' => 'Chauffe-eau solaire individuel (France d\'outre-mer)',
            'FICHE' => 'BAR-TH-124',
            'URL' => 'https://atee.fr/system/files/2020-08/BAR-TH-124%20v%20A35-3%20%C3%A0%20compter%20du%2001-10-2020.pdf',
            'OUVRAGES' => [ 'TH_32' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est une maison individuelle',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON"' ]
                ], [
                    'DESCRIPTION' => 'Le logement est situé dans un département d\'outre-mer',
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
                            'DESCRIPTION' => 'Logement existant - Guadeloupe / Martinique / Mayotte',
                            'EXPRESSIONS' => [
                                '$AGE_LOGEMENT >= 2 && ($CODE_DEPARTEMENT = "971" || $CODE_DEPARTEMENT = "972" || $CODE_DEPARTEMENT = "976")'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CAPTEURS_SOLAIRES * 5300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Logement neuf - Guadeloupe / Martinique / Mayotte',
                            'EXPRESSIONS' => [
                                '$AGE_LOGEMENT < 2 && ($CODE_DEPARTEMENT = "971" || $CODE_DEPARTEMENT = "972" || $CODE_DEPARTEMENT = "976")'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CAPTEURS_SOLAIRES * 2600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Logement existant - Réunion',
                            'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2 && $CODE_DEPARTEMENT = "974"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CAPTEURS_SOLAIRES * 4300'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Logement neuf - Réunion',
                            'EXPRESSIONS' => [ '$AGE_LOGEMENT < 2 && $CODE_DEPARTEMENT = "974"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CAPTEURS_SOLAIRES * 2100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Logement existant - Guyane',
                            'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2 && $CODE_DEPARTEMENT = "973"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CAPTEURS_SOLAIRES * 5400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Logement neuf - Guyane',
                            'EXPRESSIONS' => [ '$AGE_LOGEMENT < 2 && $CODE_DEPARTEMENT = "973"' ]
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_CAPTEURS_SOLAIRES * 3100'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'SURFACE_CAPTEURS_SOLAIRES'
            ]
        ], [
            'NOM' => 'Système de ventilation double flux autoréglable ou modulé à haute performance (France métropolitaine)',
            'FICHE' => 'BAR-TH-125',
            'URL' => 'https://atee.fr/system/files/2020-10/BAR-TH-125_FS%26AH_Ventilation%20DF%20v36.pdf',
            'OUVRAGES' => [ 'TH_36' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Le logement est situé en France métropolitaine',
                    'EXPRESSIONS' => [ '$FRANCE_METROPOLITAINE = true' ]
                ]
            ],
            'VALEURS' => [
                // Montant - VMC autoréglable collective
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC autoréglable -Installation collective - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "AUTO" && $CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 23000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC autoréglable -Installation collective - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "AUTO" && $CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 18800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC autoréglable - Installation collective - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "AUTO" && $CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 12500'
                ],
                // Montant - VMC autoréglable individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC autoréglable -Installation individuelle - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "AUTO" && $CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '39700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC autoréglable -Installation individuelle - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "AUTO" && $CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '32500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC autoréglable - Installation individuelle - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "AUTO" && $CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '21600'
                ],
                // Montant - VMC modulée individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC modulée -Installation individuelle - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "MOD" && $CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '42000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC modulée -Installation individuelle - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "MOD" && $CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '34400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'VMC modulée - Installation individuelle - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_VMC_DOUBLE_FLUX = "MOD" && $CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '22900'
                ],
                // Facteur correctif - Installation individuelle
                [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'S < 35',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE < 35'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.3'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '35 ≤ S < 60',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE >= 35 && $SURFACE_HABITABLE < 60'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.5'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '60 ≤ S < 70',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE >= 60 && $SURFACE_HABITABLE < 70'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.6'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '70 ≤ S < 90',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE >= 70" && $SURFACE_HABITABLE < 90'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '0.7'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '90 ≤ S < 110',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE >= 90 && $SURFACE_HABITABLE < 110'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '110 ≤ S < 130',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE >= 110 && $SURFACE_HABITABLE < 130'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1.1'
                ], [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface habitable',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => '130 < S',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT <> "BAT_COLLECTIF" && $SURFACE_HABITABLE > 130'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1.6'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_DEPARTEMENT',
                'NOMBRE_LOGEMENTS',
                'CODE_TYPE_VMC_DOUBLE_FLUX'
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
