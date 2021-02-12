<?php

namespace App\DataFixtures\PrimeEnergie;

abstract class ValeurFixtures
{
    /**
     * @var array
     */
    const FACTEURS_CORRECTIFS_MAISON = [
        [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Maison individuelle - S < 70',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE < 70'
                    ]
                ]
            ],
            'EXPRESSION' => '0.5'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Maison individuelle - 70 ≤ S < 90',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 70 && $SURFACE_CHAUFFEE < 90'
                    ]
                ]
            ],
            'EXPRESSION' => '0.7'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Maison individuelle - 90 ≤ S < 110',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 90 && $SURFACE_CHAUFFEE < 110'
                    ]
                ]
            ],
            'EXPRESSION' => '1'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Maison individuelle - 110 ≤ S < 130',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE >= 110 && $SURFACE_CHAUFFEE < 130'
                    ]
                ]
            ],
            'EXPRESSION' => '1.1'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Maison individuelle - 130 < S',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE > 130'
                    ]
                ]
            ],
            'EXPRESSION' => '1.6'
        ]
    ];

    /**
     * @var array
     */
    const FACTEURS_CORRECTIFS_APPARTEMENT = [
        [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - S < 35',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE < 35'
                    ]
                ]
            ],
            'EXPRESSION' => '0.5'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - 35 ≤ S < 60',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 35 && $SURFACE_CHAUFFEE < 60'
                    ]
                ]
            ],
            'EXPRESSION' => '0.7'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - 60 ≤ S < 70',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 60 && $SURFACE_CHAUFFEE < 70'
                    ]
                ]
            ],
            'EXPRESSION' => '1'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - 70 ≤ S < 90',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 70 && $SURFACE_CHAUFFEE < 90'
                    ]
                ]
            ],
            'EXPRESSION' => '1.2'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - 90 ≤ S < 110',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 90 && $SURFACE_CHAUFFEE < 110'
                    ]
                ]
            ],
            'EXPRESSION' => '1.5'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - 110 ≤ S < 130',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 110 && $SURFACE_CHAUFFEE < 130'
                    ]
                ]
            ],
            'EXPRESSION' => '1.9'
        ], [
            'TYPE' => 'facteur',
            'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Appartement - 130 < S',
                    'EXPRESSIONS' => [
                        '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE > 130'
                    ]
                ]
            ],
            'EXPRESSION' => '2.5'
        ]
    ];
}
