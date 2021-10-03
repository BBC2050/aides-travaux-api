<?php

namespace App\Api\Resource;

class SimulationDispositif
{
    public ?int $id = null;
    public ?string $code = null;
    public ?string $nom = null;
    public ?string $description = null;
    public ?string $type = null;
    public ?string $logoUrl = null;
    public array $conditions = [];
    public array $valeurs = [];
    public array $exclusions = [];
    public array $distributeur = [];
    public ?Simulation $simulation = null;


    // Données de sortie

    public function isEligible(): ?bool
    {
        foreach ($this->simulation->getOffresEligibles() as $offre) {
            if ($offre->dispositif === $this->id) {
                return true;
            }
        }
        return false;
    }

    public function getPlafond(): ?float
    {
        $plafonds = \array_filter($this->valeurs, function(SimulationValeur $item) {
            return $item->type === 'plafond' && $item->apply() && $item->getResponse() !== null;
        });
        $plafonds = \array_map(function(SimulationValeur $item) {
            return $item->getResponse();
        }, $plafonds);

        return \count($plafonds) > 0 ? \min($plafonds): null;
    }

}
