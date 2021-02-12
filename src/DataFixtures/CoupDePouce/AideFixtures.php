<?php

namespace App\DataFixtures\CoupDePouce;

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
        'CODE' => 'CEE_COUP_DE_POUCE',
        'NOM' => 'Coup de pouce économies d\'énergie',
        'DESCRIPTION' => 'A venir',
        'DELAI' => 'Versement après travaux',
        'INFORMATION' => 'https://www.ecologie.gouv.fr/coup-pouce-chauffage-et-isolation',
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
        'VALEURS' => [],
        'VARIABLES' => []
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
