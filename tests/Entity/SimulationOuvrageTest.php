<?php

namespace App\Tests\Entity;

use App\Entity\Condition;
use App\Entity\Expression;
use PHPUnit\Framework\TestCase;
use App\Entity\Aide;
use App\Entity\Offre;
use App\Entity\Simulation;
use App\Entity\SimulationOuvrage;

class SimulationOuvrageTest extends TestCase
{
    public function testGetOffresEligibles()
    {
        $simulationOuvrage = (new SimulationOuvrage())
            ->addOffre((new Offre())->setAide((new Aide())))
            ->addOffre((new Offre())->setAide((new Aide())))
            ->addOffre((new Offre())->setAide((new Aide())->addCondition(
                (new Condition())->addExpression((new Expression())->setResponse(false))
            )));

        $this->assertCount(2, $simulationOuvrage->getOffresEligibles());
    }

    public function testGetCout()
    {
        $this->assertEquals(0, (new SimulationOuvrage())->setSimulation((new Simulation()))->getCout());
        $this->assertEquals(1000, (new SimulationOuvrage())->setSimulation((new Simulation()))
            ->setVariables(['COUT_TTC' => 1000])->getCout());
    }
}
