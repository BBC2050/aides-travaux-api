<?php

namespace App\DataFixtures\HabiterMieux;

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
                    'DESCRIPTION' => 'Les travaux permettant un gain énergétique d’au moins 25%',
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
                            'EXPRESSIONS' => ConditionFixtures::PLAFONDS_MODESTE
                        ]
                    ],
                    'EXPRESSION' => '$COUT_HT * 0.35 + $COUT_HT * 0.1'
                ], [
                    'TYPE' => 'montant',
                    'DESCRIPTION' => 'Prime pour les ménages très modestes',
                    'CONDITIONS' => [
                        [
                            'DESCRIPTION' => 'Les revenus du foyers sont inférieurs aux plafonds fixés',
                            'EXPRESSIONS' => ConditionFixtures::PLAFONDS_TRES_MODESTE
                        ]
                    ],
                    'EXPRESSION' => '$COUT_HT * 0.5 + $COUT_HT * 0.1'
                ]
            ],
            'VARIABLES' => [ 'COUT_HT' ]
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
