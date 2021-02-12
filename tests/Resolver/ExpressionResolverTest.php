<?php

namespace App\Tests\Resolver;

use App\Entity\Expression;
use App\Entity\Simulation;
use App\Entity\SimulationAide;
use PHPUnit\Framework\TestCase;
use App\Resolver\ExpressionResolver;

class ExpressionResolverTest extends TestCase
{
    const SURFACE_HABITABLE = 10;

    /**
     * @dataProvider provideData
     */
    public function testResolve($expression, $expect)
    {
        $expression = (new Expression())->setExpression($expression);

        $data = (new Simulation())
            ->setVariables([ 'SURFACE_HABITABLE' => self::SURFACE_HABITABLE])
            ->addAide((new SimulationAide())
        );

        ExpressionResolver::resolve($expression, $data->getAides()->first());

        $this->assertEquals($expect, $expression->getResponse());
    }

    public function provideData()
    {
        return [
            [ null, null ],
            [ '10 + 10', 20 ],
            [ '10', 10 ],
            [ 'true', true ],
            [ 'false', false ],
            [ 'null', null ],
            [ '$SURFACE_HABITABLE * 10', 100],
            [ '$SURFACE_HABITABLE === 10', true]
        ];
    }
}
