<?php

namespace App\Api\Dto\Output;

use App\Api\Resource\SimulationCondition;
use App\Api\Resource\SimulationOffre;

class SimulationOffreOutput
{
    public ?string $code = null;
    public ?string $nom = null;
    public ?string $description = null;
    public ?string $dateDebut = null;
    public ?string $dateFin = null;
    public ?bool $multiple = null;
    public ?bool $globale = null;
    public ?bool $eligible = null;
    public ?float $montant = null;
    public ?float $ecretement = null;
    public ?array $conditions = [];

    public static function fromResource(SimulationOffre $data): self
    {
        $output = new Self();
        $output->code = $data->code;
        $output->nom = $data->nom;
        $output->description = $data->description;
        $output->dateDebut = $data->dateDebut;
        $output->dateFin = $data->dateFin;
        $output->multiple = $data->multiple;
        $output->globale = $data->globale;
        $output->eligible = $data->isEligible();
        $output->montant = $data->getMontant();
        $output->ecretement = $data->getEcretement();
        $output->conditions = \array_map(function(SimulationCondition $item) {
            return SimulationConditionOutput::fromResource($item);
        }, $data->conditions);

        return $output;
    }

}
