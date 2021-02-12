<?php

namespace App\DataFixtures\PrimeEnergie;

use App\DataFixtures\OuvrageFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use App\DataFixtures\OffreFixturesTrait;
use App\Entity\Offre;
use App\Entity\OffreCee;

class OffreTH10XFixtures extends Fixture implements DependentFixtureInterface
{
    use OffreFixturesTrait;
    
    /**
     * @var array
     */
    const OFFRES = [
        [
            'NOM' => 'Chauffe-eau solaire individuel (France métropolitaine)',
            'FICHE' => 'BAR-TH-101',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-101_0_0.pdf',
            'OUVRAGES' => [ 'TH_32' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle achevée depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $AGE_LOGEMENT >= 2' ]
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
                            'DESCRIPTION' => 'H1',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H1"']
                        ]
                    ],
                    'EXPRESSION' => '21500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H2',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H2"']
                        ]
                    ],
                    'EXPRESSION' => '24100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'H3',
                            'EXPRESSIONS' => [ '$CODE_ZONE_CLIMATIQUE = "H3"']
                        ]
                    ],
                    'EXPRESSION' => '27600'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'CODE_DEPARTEMENT'
            ]
        ], [
            'NOM' => 'Chauffe-eau solaire collectif (France métropolitaine)',
            'FICHE' => 'BAR-TH-102',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-102_0.pdf',
            'OUVRAGES' => [ 'TH_32' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le bâtiment est un immeuble collectif achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF" && $AGE_LOGEMENT >= 2' ]
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
                    'EXPRESSION' => '$BESSOIN_ECS * ($PRODUCTION_SOLAIRE / $BESSOIN_ECS * 100) * "0.196"'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'BESSOIN_ECS',
                'TAUX_COUVERTURE_SOLAIRE',
                'PRODUCTION_SOLAIRE'
            ]
        ], [
            'NOM' => 'Pompe à chaleur de type air/eau ou eau/eau',
            'FICHE' => 'BAR-TH-104',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-104_mod_a23-2_apres_01-02-2017_1.pdf',
            'OUVRAGES' => [ 'TH_20', 'TH_21' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
                ], [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                // Montant - Maison individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 102% ≤ ηs < 110% - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 102" && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 110" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '52700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 102% ≤ ηs < 110% - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 102" && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 110" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '43100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 102% ≤ ηs < 110% - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 102" && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 110" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '28700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 110% ≤ ηs < 120% - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 110 && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 120 && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '66400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 110% ≤ ηs < 120% - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 110 && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 120 && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '54400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 110% ≤ ηs < 120% - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 110 && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 120 && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '79900'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 120% ≤ ηs - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 120 && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '79900'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 120% ≤ ηs - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 120 && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '65400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - 120% ≤ ηs - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 120 && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '43600'
                ],
                // Montant - Appartement
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 102% ≤ ηs < 110% - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 102" && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 110" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '24500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 102% ≤ ηs < 110% - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 102" && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 110" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '20100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 102% ≤ ηs < 110% - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 102" && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 110" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '13400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 110% ≤ ηs < 120% - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 110 && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 120 && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '32200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 110% ≤ ηs < 120% - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 110 && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 120 && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '26400'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 110% ≤ ηs < 120% - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 110 && $EFFICACITE_ENERGETIQUE_SAISONNIERE < 120 && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '17600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 120% ≤ ηs - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 120 && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '39700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 120% ≤ ηs - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 120 && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '32500'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - 120% ≤ ηs - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $EFFICACITE_ENERGETIQUE_SAISONNIERE >= 120 && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '21700'
                ],
                // Facteur correctif - Maison individuelle
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
                            'DESCRIPTION' => 'Maison individuelle - 90 ≤ S < 110',
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
                            'DESCRIPTION' => 'Maison individuelle - 110 ≤ S < 130',
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
                            'DESCRIPTION' => 'Maison individuelle - 130 < S',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_CHAUFFEE > 130'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1.6'
                ],
                // Facteur correctif - Appartement
                [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - S < 35',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE < "35"'
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
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= "35" && $SURFACE_CHAUFFEE < 60'
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
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 70" && $SURFACE_CHAUFFEE < 90'
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
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 90" && $SURFACE_CHAUFFEE < 110'
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
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $SURFACE_CHAUFFEE >= 110" && $SURFACE_CHAUFFEE < 130'
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
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'SURFACE_CHAUFFEE',
                'EFFICACITE_ENERGETIQUE_SAISONNIERE'
            ]
        ], [
            'NOM' => 'Chaudière individuelle à haute performance énergétique',
            'FICHE' => 'BAR-TH-106',
            'URL' => 'https://atee.fr/system/files/2020-01/bar-th-106_mod_a23-2_apres_01-02-2017_1_0.pdf',
            'OUVRAGES' => [ 'TH_01', 'TH_02' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
                ], [
                    'DESCRIPTION' => 'Le logement est achevé depuis plus de deux ans',
                    'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                // Montant - Maison individuelle
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '46900'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '39600'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '28500'
                ],
                // Montant - Appartement
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H1',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H1"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '24800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H2',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H2"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '21200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de certificats en kWh cumac',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Appartement - H3',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "APPARTEMENT" && $CODE_ZONE_CLIMATIQUE = "H3"'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '15800'
                ],
                // Facteur correctif - Maison individuelle
                [
                    'TYPE' => 'facteur',
                    'DESCRIPTION' => 'Facteur correctif selon la surface chauffée',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Maison individuelle - S < 70',
                            'EXPRESSIONS' => [
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_HABITABLE < 70'
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
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_HABITABLE >= 70" && $SURFACE_HABITABLE < 90'
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
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_HABITABLE >= 90" && $SURFACE_HABITABLE < 110'
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
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_HABITABLE >= 110" && $SURFACE_HABITABLE < 130'
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
                                '$CODE_TYPE_LOGEMENT = "MAISON" && $SURFACE_HABITABLE > 130'
                            ]
                        ]
                    ],
                    'EXPRESSION' => '1.6'
                ]
            ],
            'VARIABLES' => [
                'CODE_DEPARTEMENT',
                'CODE_TYPE_LOGEMENT',
                'AGE_LOGEMENT',
                'SURFACE_HABITABLE'
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
