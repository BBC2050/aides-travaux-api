<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use App\Utils\ExpressionLangageBuilder;

class ExpressionLangageBuilderTest extends TestCase
{
    public function testGet()
    {
        $expressionLangage = ExpressionLangageBuilder::get();
        $this->assertTrue($expressionLangage instanceof ExpressionLanguage);
    }
}
