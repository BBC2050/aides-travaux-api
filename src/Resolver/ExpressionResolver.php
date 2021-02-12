<?php

namespace App\Resolver;

use App\Entity\Expression;

abstract class ExpressionResolver
{
    public static function resolve(Expression $expression, Object $data): void
    {
        $response = ExpressionLanguageBuilder::get()->evaluate(
            $expression->getExpressionLanguage(), [ 'object' => $data ]
        );
        $expression->setResponse($response);
    }
}
