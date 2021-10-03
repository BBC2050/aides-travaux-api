<?php

namespace App\Api\Resource;

class SimulationAction
{
    public ?int $id = null;
    public ?string $code = null;
    public ?string $nom = null;
    public ?string $categorie = null;
    public array $variables = [];
    public array $offres = [];
    public ?Simulation $simulation = null;

    // Validation

    public function getVariables()
    {
        foreach ($this->offres as $key => $value) {
            # code...
        }
    }

    // Logique interne

    public function getOffresDisponibles(): array
    {
        return \array_filter($this->offres, function(SimulationOffre $offre) {
            if ($offre->globale === false) {
                return true;
            }
            return \count(
                \array_filter($this->offres, function(SimulationOffre $item) use ($offre) {
                    return $item->dispositif === $offre->dispositif && $item->globale === false;
                })
            ) > 0;
        });
    }

    public function getOffresEligibles(): array
    {
        return \array_filter($this->getOffresDisponibles(), function(SimulationOffre $item) {
            return $item->isEligible();
        });
    }

    // Données de sortie

    public function getCoutHT(): ?float
    {
        return $this->variables['$T.cout_ht_total'] ?? 0;
    }

    public function getCoutTTC(): ?float
    {
        return $this->variables['$T.cout_ttc_total'] ?? 0;
    }

    public function getPrimes(): ?float
    {
        return 0;
    }

    public function getPrimesCee(): ?float
    {
        return 0;
    }

    public function getAvances(): ?float
    {
        return 0;
    }

    public function getExonerations(): ?float
    {
        return 0;
    }

}
