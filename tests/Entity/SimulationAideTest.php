<?php

namespace App\Tests\Entity;

use App\Entity\Condition;
use App\Entity\Expression;
use PHPUnit\Framework\TestCase;
use App\Entity\Aide;
use App\Entity\Offre;
use App\Entity\Valeur;
use App\Entity\SimulationAide;

class SimulationAideTest extends TestCase
{
    public function testGetPlafond()
    {
        $simulationAide = (new SimulationAide())->setAide((new Aide())
            ->addValeur((new Valeur())->setType('montant')
                ->setExpression((new Expression())->setResponse(10)))
            ->addValeur((new Valeur())->setType('plafond')
                ->setExpression((new Expression())->setResponse(20))
                ->addCondition((new Condition())->addExpression((new Expression())->setResponse(false))))
            ->addValeur((new Valeur())->setType('plafond')
                ->setExpression((new Expression())->setResponse(40))
                ->addCondition((new Condition())->addExpression((new Expression())->setResponse(true))))
            ->addValeur((new Valeur())->setType('plafond')
                ->setExpression((new Expression())->setResponse(30))
                ->addCondition((new Condition())->addExpression((new Expression())->setResponse(true))))
        );

        $this->assertEquals(30, $simulationAide->getPlafond());
    }
}
