<?php

namespace App\Api\Resource;

use App\Entity\Secteur;

class Simulation
{
    public int $id = 1;
    public ?Secteur $secteur = null;
    public array $variables = [];
    public array $dispositifs = [];
    public array $actions = [];

    // Logique interne

    public function getOffres(): array
    {
        $offres = [];

        foreach ($this->actions as $action) {
            foreach ($action->offres as $offre) {
                $offres[] = $offre;
            }
        }

        return $offres;
    }

    public function getOffresDisponibles(): array
    {
        $offres = [];

        foreach ($this->actions as $action) {
            foreach ($action->getOffresDisponibles() as $offre) {
                $offres[] = $offre;
            }
        }

        return $offres;
    }

    public function getOffresEligibles(): array
    {
        $offres = [];

        foreach ($this->actions as $action) {
            foreach ($action->getOffresEligibles() as $offre) {
                $offres[] = $offre;
            }
        }

        return $offres;
    }

}
