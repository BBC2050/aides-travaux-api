<?php

namespace App\Api\Dto\Output;

use App\Api\Resource\SimulationAction;
use App\Api\Resource\SimulationOffre;

class SimulationActionOutput
{
    public ?string $code = null;
    public ?string $nom = null;
    public ?string $categorie = null;
    public ?float $primes = null;
    public ?float $avances = null;
    public ?float $exonerations = null;
    public array $offres = [];

    public static function fromResource(SimulationAction $data): self
    {
        $output = new Self();
        $output->code = $data->code;
        $output->nom = $data->nom;
        $output->categorie = $data->categorie;
        $output->offres = \array_map(function(SimulationOffre $item) {
            return SimulationOffreOutput::fromResource($item);
        }, $data->getOffresDisponibles());

        return $output;
    }

}
