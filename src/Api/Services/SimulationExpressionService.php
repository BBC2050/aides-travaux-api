<?php

namespace App\Api\Services;

use App\Api\Resource\SimulationExpression;
use App\Entity\Expression;

abstract class SimulationExpressionService
{
    public static function fromEntity(Expression $data): SimulationExpression
    {
        $resource = new SimulationExpression();
        $resource->expression = $data->getExpressionLanguage();

        return $resource;
    }

}
