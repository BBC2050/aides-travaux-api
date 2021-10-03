<?php

namespace App\Api\Services;

use App\Api\Resource\SimulationValeur;
use App\Entity\Valeur;

abstract class SimulationValeurService
{
    public static function fromEntity(Valeur $data): SimulationValeur
    {
        $resource = new SimulationValeur();

        $resource->description = $data->getDescription();
        $resource->type = $data->getType();
        $resource->globale = $data->getGlobale();
        $resource->condition = $data->getCondition()
            ? SimulationExpressionService::fromEntity($data->getCondition())
            : null;
        $resource->expression = $data->getExpression()
            ? SimulationExpressionService::fromEntity($data->getExpression())
            : null;

        return $resource;
    }
}
