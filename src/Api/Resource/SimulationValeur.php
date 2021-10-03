<?php

namespace App\Api\Resource;

class SimulationValeur
{
    public ?string $description = null;
    public ?string $type = null;
    public ?bool $globale = null;
    public ?SimulationExpression $condition = null;
    public ?SimulationExpression $expression = null;

    public function apply(): ?bool
    {
        return $this->condition === null || $this->condition->response === true ? true : false;
    }

    public function getResponse(): mixed
    {
        return $this->expression ? $this->expression->response : null;
    }

}
