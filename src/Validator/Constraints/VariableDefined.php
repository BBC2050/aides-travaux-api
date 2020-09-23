<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class VariableDefined extends Constraint
{
    public $message = 'Variable {{ name }} is required';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
