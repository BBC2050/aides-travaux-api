<?php

namespace App\Api\Dto\Output;

use App\Api\Resource\SimulationDispositif;

class SimulationDispositifOutput
{
    public ?int $id = null;
    public ?string $code = null;
    public ?string $nom = null;
    public ?string $description = null;
    public ?string $type = null;
    public ?string $logoUrl = null;
    public array $exclusions = [];
    public array $distributeur = [];
    public ?bool $eligible = null;
    public ?float $plafond = null;

    public static function fromResource(SimulationDispositif $data): self
    {
        $output = new Self();
        $output->id = $data->id;
        $output->code = $data->code;
        $output->nom = $data->nom;
        $output->description = $data->description;
        $output->type = $data->type;
        $output->logoUrl = $data->logoUrl;
        $output->distributeur = $data->distributeur;
        $output->exclusions = $data->exclusions;
        $output->eligible = $data->isEligible();
        $output->plafond = $data->getPlafond();

        return $output;
    }

}
