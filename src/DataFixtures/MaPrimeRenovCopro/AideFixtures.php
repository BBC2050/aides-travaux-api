<?php

namespace App\DataFixtures\MaPrimeRenovCopro;

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
        'CODE' => 'MA_PRIME_RENOV_COPROPRIETE',
        'NOM' => 'Ma Prime Rénov\' Copropriété',
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
                'DESCRIPTION' => 'Le bâtiment est une copropriété',
                'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "BAT_COLLECTIF"' ]
            ], [
                'DESCRIPTION' => 'Les travaux garantissent une amélioration significative du confort et de la performance énergétique de la copropriété (35% minimum de gain énergétique après travaux)',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'La copropriété est composée d\'au moins 75% de lots d’habitation principale',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'La copropriété est immatriculée au registre national des copropriétés',
                'EXPRESSIONS' => []
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
                'EXPRESSION' => '$NOMBRE_LOGEMENTS * 500'
            ], [
                'TYPE' => 'terme',
                'DESCRIPTION' => 'Bâtiment Basse Consommation',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Les travaux permettent d\'atteindre une étiquette énergie A ou B',
                        'EXPRESSIONS' => [ '$RENOVATION_BBC' ]
                    ]
                ],
                'EXPRESSION' => '$NOMBRE_LOGEMENTS * 500'
            ]
        ],
        'VARIABLES' => [
            'CODE_TYPE_LOGEMENT',
            'NOMBRE_LOGEMENTS',
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
