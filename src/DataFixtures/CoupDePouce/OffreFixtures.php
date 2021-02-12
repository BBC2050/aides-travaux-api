<?php

namespace App\DataFixtures\CoupDePouce;

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
            'NOM' => 'Appareil indépendant de chauffage au bois',
            'FICHE' => 'BAR-TH-112',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/BAR-TH-112.pdf',
            'OUVRAGES' => [ 'TH_12', 'TH_13', 'TH_14', 'TH_15', 'TH_16', 'TH_17' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2 && $CODE_TYPE_LOGEMENT = "MAISON"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'un poêle à charbon',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '800'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '500'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Chaudière à biomasse',
            'FICHE' => 'BAR-TH-113',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/Fiche%20BAR-TH-113.pdf',
            'OUVRAGES' => [ 'TH_09', 'TH_10', 'TH_11' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2 && $CODE_TYPE_LOGEMENT = "MAISON"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'une chaudière individuelle au charbon, au fioul ou au gaz, autre qu\'à condensation',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '4000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2500'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Chaudière gaz à très haute performance énergétique',
            'FICHE' => 'BAR-TH-106',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/BAR-TH-106%20mod%20A23-2%20apr%C3%A8s%2001-02-2017.pdf',
            'OUVRAGES' => [ 'TH_02' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'une chaudière individuelle au charbon, au fioul ou au gaz, autre qu\'à condensation',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '1200'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '600'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Conduit d\'évacuation des produits de combustion',
            'FICHE' => 'BAR-TH-163',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/BAR-TH-163.pdf',
            'OUVRAGES' => [ 'DIV_02' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est un bâtiment résidentiel collectif',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF"']
                ], [
                    'DESCRIPTION' => 'Les logements disposent d\'un chauffage central individuel utilisant un combustible gazeux',
                    'EXPRESSIONS' => ['$CODE_TYPE_CHAUFFAGE = "INDIV" && $CODE_ENERGIE_CHAUFFAGE = "GAZ"']
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '450'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Émetteur électrique performant',
            'FICHE' => 'BAR-TH-158',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/BAR-TH-158_0.pdf',
            'OUVRAGES' => [ 'TH_03' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'un ancien radiateur électrique fixe',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 100'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$NOMBRE_EQUIPEMENTS * 50'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT',
                'NOMBRE_EQUIPEMENTS'
            ]
        ], [
            'NOM' => 'Isolation de combles ou de toitures',
            'FICHE' => 'BAR-EN-101',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/Fiche%20BAR-EN-101.pdf',
            'OUVRAGES' => [ 'ENV_10', 'ENV_11', 'ENV_12' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 20'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 10'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Isolation d\'un plancher bas',
            'FICHE' => 'BAR-EN-103',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/BAR-EN-103%20%C3%A0%20compter%20du%2001%20septembre%202020.pdf',
            'OUVRAGES' => [ 'ENV_08', 'ENV_09' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'Le plancher bas donne sur un sous-sol, un vide sanitaire, ou un passage ouvert',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 20'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$SURFACE_ISOLANT * 10'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT',
                'SURFACE_ISOLANT'
            ]
        ], [
            'NOM' => 'Pompe à chaleur air/eau ou eau/eau',
            'FICHE' => 'BAR-TH-104',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/Fiche%20BAR-TH-104.pdf',
            'OUVRAGES' => [ 'TH_20', 'TH_21' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'une chaudière individuelle au charbon, au fioul ou au gaz, autre qu\'à condensation',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '4000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2500'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Pompe à chaleur hybride air/eau',
            'FICHE' => 'BAR-TH-159',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/Fiche%20BAR-TH-159.pdf',
            'OUVRAGES' => [ 'TH_23' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'une chaudière individuelle au charbon, au fioul ou au gaz, autre qu\'à condensation',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '4000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2500'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Raccordement à un réseau de chaleur',
            'FICHE' => 'BAR-TH-137',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/Fiche%20BAR-TH-137.pdf',
            'OUVRAGES' => [ 'TH_05' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2']
                ], [
                    'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                    'EXPRESSIONS' => ['$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"']
                ], [
                    'DESCRIPTION' => 'Le bâtiment n\'a jamais été raccordé à un réseau de chaleur avant la réalisation de l\'opération',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '700'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '450'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
            ]
        ], [
            'NOM' => 'Système solaire combiné',
            'FICHE' => 'BAR-TH-143',
            'URL' => 'https://www.ecologie.gouv.fr/sites/default/files/Fiche%20BAR-TH-143.pdf',
            'OUVRAGES' => [ 'TH_33' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Le logement est une maison individuelle âgé de plus de deux ans',
                    'EXPRESSIONS' => ['$AGE_LOGEMENT >= 2 && $CODE_TYPE_LOGEMENT = "MAISON"']
                ], [
                    'DESCRIPTION' => 'L\'équipement installé vient en remplacement d\'une chaudière individuelle au charbon, au fioul ou au gaz, autre qu\'à condensation',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Le système est couplé à des emetteurs de chauffage central basse température',
                    'EXPRESSIONS' => []
                ], [
                    'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::HABITER_MIEUX_PLAFONDS
                        ]
                    ],
                    'EXPRESSION' => '4000'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les autres ménages',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '2500'
                ]
            ],
            'VARIABLES' => [
                'CODE_REGION',
                'COMPOSITION_FOYER',
                'REVENUS_FOYER',
                'AGE_LOGEMENT',
                'CODE_TYPE_LOGEMENT'
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
