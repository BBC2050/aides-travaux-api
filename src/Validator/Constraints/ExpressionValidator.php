<?php

namespace App\Validator\Constraints;

class ExpressionValidator
{
    public function validate(string $expression)
    {
        $regex = '/\b(\w*object.\w*)\b/ig';
    }
}
