<?php

namespace App\Api\Dto\Output;

use App\Api\Resource\Simulation;
use App\Api\Resource\SimulationDispositif;
use App\Api\Resource\SimulationAction;

class SimulationOutput
{
    public array $dispositifs = [];
    public array $actions = [];
    public ?float $primes = null;
    public ?float $avances = null;
    public ?float $exonerations = null;

    public static function fromResource(Simulation $data): self
    {
        $output = new Self();
        $output->dispositifs = \array_map(function(SimulationDispositif $item) {
            return SimulationDispositifOutput::fromResource($item);
        }, $data->dispositifs);
        $output->actions = \array_map(function(SimulationAction $item) {
            return SimulationActionOutput::fromResource($item);
        }, $data->actions);

        return $output;
    }

}
