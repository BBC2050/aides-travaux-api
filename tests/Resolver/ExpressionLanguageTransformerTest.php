<?php

namespace App\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use App\Resolver\ExpressionLanguageTransformer;

class ExpressionLanguageTransformerTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testTransform($expression, $expect)
    {
        $this->assertEquals(ExpressionLanguageTransformer::transform($expression), $expect);
    }

    public function provideData()
    {
        return [
            [ null, 'null' ],
            [ '10 + 10', '10 + 10' ],
            [ '10', '10' ],
            [ 'true', 'true' ],
            [ 'false', 'false' ],
            [ 'null', 'null' ],
            [ ' = <> and or ', ' === !== && || '],
            [ '$VARIABLE', 'object.get(\'VARIABLE\')']
        ];
    }
}
