<?php

namespace App\Api\Resource;

class SimulationCondition
{
    public ?string $description = null;
    public ?SimulationExpression $expression = null;

    public function isValide(): ?bool
    {
        if ($this->expression === null) {
            return null;
        }
        return $this->expression->response === true ? true : false;
    }

}
