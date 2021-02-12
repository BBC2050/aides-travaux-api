<?php

namespace App\DataFixtures\HabiterMieux;

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
        'CODE' => 'ANAH_HABITER_MIEUX',
        'NOM' => 'HabiterMieux',
        'DESCRIPTION' => 'A venir',
        'DELAI' => 'Versement après travaux',
        'INFORMATION' => 'https://www.anah.fr/proprietaires/proprietaires-occupants/etre-mieux-chauffe-avec-habiter-mieux-et-maprimerenov/',
        'TYPE' => 'prime',
        'ACTIVE' => true,
        'DISTRIBUTEUR' => '1',
        'CUMUL' => [ 'ECO_PTZ' ],
        'CONDITIONS' => [
            [
                'DESCRIPTION' => 'Le logement est achevé depuis au moins 15 ans',
                'EXPRESSIONS' => ['$AGE_LOGEMENT >= 15']
            ], [
                'DESCRIPTION' => 'Le logement est occupé par son ou ses propriétaires',
                'EXPRESSIONS' => ['$CODE_STATUT = "PROP_OCCUPANT"']
            ], [
                'DESCRIPTION' => 'Le logement est habité en tant que résidence principale pendant au moins 6 ans après la fin des travaux',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'La demande de prime intervient avant le démarrage des travaux',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'Le demandeur n\'a pas bénéficié d\'un PTZ (prêt à taux zéro pour l\'accession à la propriété) depuis 5 ans',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                'EXPRESSIONS' => []
            ], [
                'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                'EXPRESSIONS' => ConditionFixtures::PLAFONDS
            ]
        ],
        'VALEURS' => [
            [
                'TYPE' => 'plafond',
                'DESCRIPTION' => 'Montant maximal des travaux pris en charge',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                        'EXPRESSIONS' => ConditionFixtures::PLAFONDS_MODESTE
                    ]
                ],
                'EXPRESSION' => '8600'
            ], [
                'TYPE' => 'plafond',
                'DESCRIPTION' => 'Montant maximal des travaux pris en charge',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                        'EXPRESSIONS' => ConditionFixtures::PLAFONDS_TRES_MODESTE
                    ]
                ],
                'EXPRESSION' => '12000'
            ]
        ],
        'VARIABLES' => [
            'CODE_REGION',
            'COMPOSITION_FOYER',
            'REVENUS_FOYER',
            'AGE_LOGEMENT',
            'CODE_STATUT'
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
