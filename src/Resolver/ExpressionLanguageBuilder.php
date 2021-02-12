<?php

namespace App\Resolver;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

abstract class ExpressionLanguageBuilder
{
    public static function get(): ExpressionLanguage
    {
        $expressionLanguage = new ExpressionLanguage();

        self::registerMinFunction($expressionLanguage);

        return $expressionLanguage;
    }

    private static function registerMinFunction(ExpressionLanguage $expressionLanguage): void
    {
        $expressionLanguage->register(
            'min', 
            function ($expr) {
                return sprintf('(is_string(%1$s) ? min(%1$s) : %1$s)', $expr);
            }, 
            function ($arguments, $expr) {
                return !is_string($expr) ? $expr : \min($expr);
            }
        );
    }
}
