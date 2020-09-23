<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\VariableToMethodTransformer;

class VariableToMethodTransformerTest extends TestCase
{
    public function testTransform()
    {
        $this->assertEquals(
            VariableToMethodTransformer::transform('TEST_VARIABLE'),
            'getTestVariable'
        );
    }

    public function testReverseTransform()
    {
        $this->assertEquals(
            VariableToMethodTransformer::reverseTransform('getTestVariable'),
            'TEST_VARIABLE'
        );
    }
}
