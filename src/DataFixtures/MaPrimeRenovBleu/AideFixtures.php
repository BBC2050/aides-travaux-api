<?php

namespace App\DataFixtures\MaPrimeRenovBleu;

use App\DataFixtures\AideFixturesTrait;
use App\DataFixtures\DistributeurFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AideFixtures extends Fixture implements DependentFixtureInterface
{
    use AideFixturesTrait;

    /**
     * @var array
     */
    const AIDE = [
        'CODE' => 'MA_PRIME_RENOV_BLEU',
        'NOM' => 'Ma Prime Rénov\' Bleu',
        'DESCRIPTION' => 'A venir',
        'DELAI' => 'Versement après travaux',
        'TYPE' => 'prime',
        'INFORMATION' => 'https://www.maprimerenov.gouv.fr/',
        'ACTIVE' => true,
        'DISTRIBUTEUR' => '1',
        'CUMUL' => [ 
            'CEE_PRIME_ENERGIE',
            'CEE_COUP_DE_POUCE',
            'ECO_PTZ'
        ],
        'CONDITIONS' => [
            [
                'DESCRIPTION' => 'Le logement est achevé depuis au moins 2 ans',
                'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
            ], [
                'DESCRIPTION' => 'Le logement est une maison individuelle ou un appartement',
                'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
            ], [
                'DESCRIPTION' => 'Le logement est occupé par son ou ses propriétaires',
                'EXPRESSIONS' => [ '$CODE_STATUT = "PROP_OCCUPANT"' ]
            ], [
                'DESCRIPTION' => 'Le logement est occupé à titre de résidence principale',
                'EXPRESSIONS' => [ '$CODE_OCCUPATION = "PRINCIPALE"' ]
            ], [
                'DESCRIPTION' => 'La demande de prime intervient avant le démarrage des travaux',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                'EXPRESSIONS' => ConditionFixtures::MA_PRIME_RENOV_BLEU_PLAFONDS
            ]
        ],
        'VALEURS' => [
            [
                'TYPE' => 'terme',
                'DESCRIPTION' => 'Bonus sortie de passoire',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Les travaux concernent un logement avec une étiquette énergie F ou G',
                        'EXPRESSIONS' => [ '$ETIQUETTE_DPE = "F" || $ETIQUETTE_DPE = "G"' ]
                    ]
                ],
                'EXPRESSION' => '1500'
            ], [
                'TYPE' => 'terme',
                'DESCRIPTION' => 'Bâtiment Basse Consommation',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Les travaux permettent d\'atteindre une étiquette énergie A ou B',
                        'EXPRESSIONS' => [ '$RENOVATION_BBC' ]
                    ]
                ],
                'EXPRESSION' => '1500'
            ]
        ],
        'VARIABLES' => [
            'CODE_REGION',
            'COMPOSITION_FOYER',
            'REVENUS_FOYER',
            'AGE_LOGEMENT',
            'CODE_TYPE_LOGEMENT',
            'CODE_STATUT',
            'CODE_OCCUPATION',
            'ETIQUETTE_DPE',
            'RENOVATION_BBC'
        ]
    ];

    public function getData(): array
    {
        return self::AIDE;
    }

    public function getDependencies()
    {
        return [ DistributeurFixtures::class ];
    }
    
}
