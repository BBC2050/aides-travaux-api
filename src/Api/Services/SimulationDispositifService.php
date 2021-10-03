<?php

namespace App\Api\Services;

use App\Api\Resource\Simulation;
use App\Api\Resource\SimulationDispositif;
use App\Entity\Condition;
use App\Entity\Dispositif;
use App\Entity\Valeur;

abstract class SimulationDispositifService
{
    public static function fromEntity(Dispositif $data, ?Simulation $parent = null): SimulationDispositif
    {
        $resource = new SimulationDispositif();

        $resource->id = $data->getId();
        $resource->code = $data->getCode();
        $resource->nom = $data->getNom();
        $resource->description = $data->getDescription();
        $resource->type = $data->getType();
        $resource->logoUrl = null;
        $resource->distributeur = [
            'nom' => $data->getDistributeur()->getNom(),
            'description' => $data->getDistributeur()->getDescription()
        ];
        $resource->simulation = $parent;

        // Exclusions
        $resource->exclusions = $data->getExclusionsCollection()->map(function(Dispositif $item) {
            return $item->getId();
        })->getValues();

        // Conditions
        $resource->conditions = $data->getConditionsCollection()->map(function(Condition $item) {
            return SimulationConditionService::fromEntity($item);
        })->getValues();

        // Valeurs
        $resource->valeurs = $data->getValeursCollection()->map(function(Valeur $item) {
            return SimulationValeurService::fromEntity($item);
        })->getValues();

        return $resource;
    }
}
