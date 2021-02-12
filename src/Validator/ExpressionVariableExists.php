<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ExpressionVariableExists extends Constraint
{
    public $message = 'Invalid variable';
}
