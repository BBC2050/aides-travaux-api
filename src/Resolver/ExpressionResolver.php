<?php

namespace App\Resolver;

abstract class ExpressionResolver
{
    public static function resolve(?string $expression, ExpressionDataInterface $data): mixed
    {
        return $expression !== null 
            ? ExpressionLanguageBuilder::get()->evaluate($expression, [ 'object' => $data ])
            : null;
    }
}
