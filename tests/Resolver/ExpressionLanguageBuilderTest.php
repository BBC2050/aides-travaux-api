<?php

namespace App\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use App\Resolver\ExpressionLanguageBuilder;

class ExpressionLanguageBuilderTest extends TestCase
{
    public function testGet()
    {
        $expressionLangage = ExpressionLanguageBuilder::get();
        $this->assertTrue($expressionLangage instanceof ExpressionLanguage);
    }
}
