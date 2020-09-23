<?php

namespace App\Utils;

abstract class VariableToMethodTransformer
{
    public static function transform(string $variable): string
    {
        return 'get'.\str_replace(' ', '', \ucwords(\strtolower(\str_replace('_', ' ', $variable))));
    }

    public static function reverseTransform(string $getter): string
    {
        return \strtoupper(\implode('_', preg_split('/(?=[A-Z])/', \lcfirst(\str_replace('get', '', $getter)))));
    }
}
