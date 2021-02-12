<?php

namespace App\DataFixtures\MaPrimeRenovCopro;

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
            'NOM' => 'Rénovation globale',
            'OUVRAGES' => [ 'DIV_04' ],
            'CONDITIONS' => [
                [
                    'DESCRIPTION' => 'Les travaux permettant un gain énergétique d\'au moins 35%',
                    'EXPRESSIONS' => []
                ]
            ],
            'VALEURS' => [
                [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Montant de la prime',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$COUT_HT * 0.25'
                ], [
                    'TYPE' => 'plafond',
                    'DESCRIPTION' => 'Plafond de la prime',
                    'CONDITIONS' => [],
                    'EXPRESSION' => '$NOMBRE_LOGEMENTS * 15000 * 0.25'
                ]
            ],
            'VARIABLES' => [ 'COUT_HT', 'NOMBRE_LOGEMENTS' ]
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
