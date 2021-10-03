<?php

namespace App\Api\Services;

use App\Api\Resource\SimulationAction;
use App\Api\Resource\SimulationOffre;
use App\Entity\Condition;
use App\Entity\Offre;
use App\Entity\Valeur;

abstract class SimulationOffreService
{
    public static function fromEntity(Offre $data, ?SimulationAction $parent = null): SimulationOffre
    {
        $resource = new SimulationOffre();

        $resource->id = $data->getId();
        $resource->dispositif = $data->getDispositif()->getId();
        $resource->code = $data->getCode();
        $resource->nom = $data->getNom();
        $resource->description = $data->getDescription();
        $resource->dateDebut = $data->getDateDebut() ? $data->getDateDebut()->format('Y-m-d') : null;
        $resource->dateFin = $data->getDateFin() ? $data->getDateFin()->format('Y-m-d') : null;
        $resource->globale = $data->getActionsCollection()->count() === 0;
        $resource->multiple = $data->getMultiple();
        $resource->action = $parent;
        
        // Exclusions
        $resource->exclusions = $data->getExclusionsCollection()->map(function(Offre $item) {
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
