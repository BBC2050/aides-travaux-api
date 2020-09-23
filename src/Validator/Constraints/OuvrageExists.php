<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class OuvrageExists extends Constraint
{
    public $message = 'Invalid ouvrage id';

    public function validatedBy()
    {
        return \get_class($this).'Validator';
    }
}
