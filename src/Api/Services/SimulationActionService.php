<?php

namespace App\Api\Services;

use App\Api\Resource\Simulation;
use App\Api\Resource\SimulationAction;
use App\Entity\Action;

abstract class SimulationActionService
{
    public static function fromEntity(Action $data, ?Simulation $parent = null): SimulationAction
    {
        $resource = new SimulationAction();

        $resource->id = $data->getId();
        $resource->code = $data->getCode();
        $resource->nom = $data->getNom();
        $resource->categorie = $data->getCategorie()->getNom();
        $resource->simulation = $parent;

        return $resource;
    }
}
