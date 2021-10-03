<?php

namespace App\Api\Services;

use App\Api\Resource\SimulationCondition;
use App\Entity\Condition;

abstract class SimulationConditionService
{
    public static function fromEntity(Condition $data): SimulationCondition
    {
        $resource = new SimulationCondition();
        $resource->description = $data->getDescription();
        $resource->expression = $data->getExpression()
            ? SimulationExpressionService::fromEntity($data->getExpression())
            : null;

        return $resource;
    }

}
