<?php

namespace App\DataFixtures\EcoPTZ;

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
        'CODE' => 'ECO_PTZ',
        'NOM' => 'Eco-prêt à taux zéro',
        'DESCRIPTION' => 'A venir',
        'DELAI' => 'Versement avant travaux',
        'INFORMATION' => 'https://particuliers.ademe.fr/finances/aides-la-renovation/tout-savoir-sur-leco-pret-taux-zero-en-2020',
        'TYPE' => 'avance',
        'ACTIVE' => true,
        'DISTRIBUTEUR' => '3',
        'CUMUL' => [ 
            'MA_PRIME_RENOV_BLEU',
            'MA_PRIME_RENOV_JAUNE',
            'MA_PRIME_RENOV_VIOLET',
            'MA_PRIME_RENOV_ROSE',
            'MA_PRIME_RENOV_COPROPRIETE',
            'ANAH_HABITER_MIEUX',
            'CEE_PRIME_ENERGIE',
            'CEE_COUP_DE_POUCE'
        ],
        'CONDITIONS' => [
            [
                'DESCRIPTION' => 'Le logement est achevé depuis au moins 2 ans',
                'EXPRESSIONS' => [ '$AGE_LOGEMENT >= 2' ]
            ], [
                'DESCRIPTION' => 'Le logement est une maison ou un appartement',
                'EXPRESSIONS' => [ '$CODE_TYPE_LOGEMENT = "MAISON" || $CODE_TYPE_LOGEMENT = "APPARTEMENT"' ]
            ], [
                'DESCRIPTION' => 'Le demandeur est propriétaire de son logement',
                'EXPRESSIONS' => [ '$CODE_STATUT = "PROP_OCCUPANT" || $CODE_STATUT = "PROP_BAILLEUR"' ]
            ], [
                'DESCRIPTION' => 'Le logement est occupé à titre de résidence principale',
                'EXPRESSIONS' => [ '$CODE_OCCUPATION = "PRINCIPALE"' ]
            ], [
                'DESCRIPTION' => 'Les travaux sont réalisés par une entreprise RGE',
                'EXPRESSIONS' => []
            ]
        ],
        'VALEURS' => [
            [
                'TYPE' => 'plafond',
                'DESCRIPTION' => 'Montant maximal d\'un prêt par logement',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Action seule',
                        'EXPRESSIONS' => [ '$TRAVAUX_ELIGIBLES = 1' ]
                    ]
                ],
                'EXPRESSION' => '15000'
            ], [
                'TYPE' => 'plafond',
                'DESCRIPTION' => 'Montant maximal d\'un prêt par logement',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Bouquet de 2 travaux',
                        'EXPRESSIONS' => [ '$TRAVAUX_ELIGIBLES = 2' ]
                    ]
                ],
                'EXPRESSION' => '25000'
            ], [
                'TYPE' => 'plafond',
                'DESCRIPTION' => 'Montant maximal d\'un prêt par logement',
                'CONDITIONS' => [
                    [
                        'DESCRIPTION' => 'Bouquet de 3 travaux ou plus',
                        'EXPRESSIONS' => [ '$TRAVAUX_ELIGIBLES >= 3' ]
                    ]
                ],
                'EXPRESSION' => '30000'
            ]
        ],
        'VARIABLES' => [
            'CODE_REGION',
            'COMPOSITION_FOYER',
            'REVENUS_FOYER',
            'AGE_LOGEMENT',
            'CODE_STATUT',
            'CODE_OCCUPATION',
            'CODE_TYPE_LOGEMENT'
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
