<?php

namespace App\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use App\Resolver\ExpressionResolver;
use App\Resolver\ExpressionDataInterface;

class ExpressionResolverTest extends TestCase
{
    const VARIABLE = 10;

    /**
     * @dataProvider provideData
     */
    public function testResolve($expression, $expect): void
    {
        $mockData = $this->createMock(ExpressionDataInterface::class);
        $mockData->method('getData')->will($this->returnValue(self::VARIABLE));

        $this->assertEquals($expect, ExpressionResolver::resolve($expression, $mockData));
    }

    public function provideData(): array
    {
        return [
            [ null, null ],
            [ '10 + 10', 20 ],
            [ '10', 10 ],
            [ 'true', true ],
            [ 'false', false ],
            [ 'null', null ],
            [ 'object.getData("$T.ma_variable") * 10', 100],
            [ 'object.getData("$T.ma_variable") === 10', true]
        ];
    }
}
