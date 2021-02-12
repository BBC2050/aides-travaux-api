<?php

namespace App\Resolver;

abstract class ExpressionLanguageTransformer
{
    public static function transform(?string $expression): string
    {
        if (null === $expression) {
            return 'null';
        }
        
        $expression = self::replaceVariables($expression);
        $expression = $expression ? self::replaceOperators($expression) : 'null';

        return (string) $expression;
    }

    private static function replaceVariables(string $expression): ?string
    {
        $expressionLanguage = preg_replace_callback(
            '/(\$\w+)/',
            function($matches) {
                $name = \str_replace('$', '', $matches[0]);

                return "object.get('".$name."')";
            },
            $expression
        );
        return $expressionLanguage ? $expressionLanguage : null;
    }

    private static function replaceOperators(string $expression): string
    {
        return \str_replace([' = ', ' <> ', ' or ', ' and '], [' === ', ' !== ', ' || ', ' && '], $expression);
    }
}
