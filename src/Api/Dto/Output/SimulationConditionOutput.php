<?php

namespace App\Api\Dto\Output;

use App\Api\Resource\SimulationCondition;

class SimulationConditionOutput
{
    public ?string $description = null;
    public ?bool $statut = null;

    public static function fromResource(SimulationCondition $data): self
    {
        $output = new Self();
        $output->description = $data->description;
        $output->statut = $data->expression ? $data->expression->response : null;

        return $output;
    }

}
