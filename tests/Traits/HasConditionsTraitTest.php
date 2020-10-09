<?php

namespace App\Tests\Traits;

use PHPUnit\Framework\TestCase;
use App\Entity\Aide;
use App\Entity\Condition;
use App\Model\Simulation;

class HasConditionsTraitTest extends TestCase
{
    public function testResolveConditions()
    {
        $aide = (new Aide())
            ->setSimulation((new Simulation()))
            ->addCondition((new Condition())
                ->setExpression('object.getNombreLogements() === 1')
            )
            ->addCondition((new Condition())
                ->setExpression('object.getAgeLogement() === 10')
            );
        $aide->resolveConditions();

        $this->assertNotNull($aide->getConditions()->first()->getResponse());
        $this->assertEquals($aide->getConditions()->first()->getResponse(), true);
        $this->assertEquals($aide->getConditions()->last()->getResponse(), false);
    }

    /**
     * @dataProvider provideData
     */
    public function testIsEligibleSimpleConditions(Aide $aide, $expect)
    {
        $aide->resolveConditions();
        $this->assertEquals($aide->isEligible(), $expect);
    }

    public function provideData()
    {
        return [
            [
                (new Aide())
                    ->setSimulation((new Simulation())->setNombreLogements(1))
                    ->addCondition((new Condition())
                        ->setExpression('object.getNombreLogements() === 1')
                    )
                , true
            ],
            [
                (new Aide())
                    ->setSimulation((new Simulation())->setNombreLogements(1))
                    ->addCondition((new Condition())
                        ->setExpression('object.getNombreLogements() === 2')
                    )
                , false
            ],
            [
                (new Aide())
                    ->setSimulation((new Simulation())->setNombreLogements(1))
                    ->addCondition((new Condition())
                        ->setGroupe('Groupe 1')
                        ->setExpression('object.getNombreLogements() === 1')
                    )
                    ->addCondition((new Condition())
                        ->setGroupe('Groupe 1')
                        ->setExpression('object.getNombreLogements() > 10')
                    )
                , true
            ],
            [
                (new Aide())
                    ->setSimulation((new Simulation())->setNombreLogements(1))
                    ->addCondition((new Condition())
                        ->setGroupe('Groupe 1')
                        ->setExpression('object.getNombreLogements() === 2')
                    )
                    ->addCondition((new Condition())
                        ->setGroupe('Groupe 1')
                        ->setExpression('object.getNombreLogements() > 10')
                    )
                , false
            ],
        ];
    }
}
