<?php

namespace App\DataFixtures\PrimeEnergie;

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
        'CODE' => 'CEE_PRIME_ENERGIE',
        'NOM' => 'Prime énergie',
        'DESCRIPTION' => 'A venir',
        'DELAI' => 'Versement après travaux',
        'INFORMATION' => 'https://www.ecologie.gouv.fr/dispositif-des-certificats-deconomies-denergie',
        'TYPE' => 'prime',
        'ACTIVE' => true,
        'DISTRIBUTEUR' => '2',
        'CUMUL' => [ 
            'MA_PRIME_RENOV_BLEU',
            'MA_PRIME_RENOV_JAUNE',
            'MA_PRIME_RENOV_VIOLET',
            'MA_PRIME_RENOV_ROSE',
            'MA_PRIME_RENOV_COPROPRIETE',
            'ECO_PTZ'
        ],
        'CONDITIONS' => [],
        'VALEURS' => [
            [
                'TYPE' => 'facteur',
                'DESCRIPTION' => 'Conversion en prime',
                'CONDITIONS' => [],
                'EXPRESSION' => '$VALEUR_CEE_CLASSIQUE'
            ]
        ],
        'VARIABLES' => [
            'VALEUR_CEE_CLASSIQUE'
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
