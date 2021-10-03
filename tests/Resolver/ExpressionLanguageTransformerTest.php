<?php

namespace App\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use App\Resolver\ExpressionLanguageTransformer;

class ExpressionLanguageTransformerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testTransform($expression, $expect): void
    {
        $this->assertEquals(ExpressionLanguageTransformer::transform($expression), $expect);
    }

    public function provideData(): array
    {
        return [
            [ null, 'null' ],
            [ '10 + 10', '10 + 10' ],
            [ '10', '10' ],
            [ 'true', 'true' ],
            [ 'false', 'false' ],
            [ 'null', 'null' ],
            [ ' = <> and or ', ' === !== && || '],
            [ '$T.ma_variable', 'object.getData(\'$T.ma_variable\')']
        ];
    }
}
