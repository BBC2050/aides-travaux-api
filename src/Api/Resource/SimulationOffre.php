<?php

namespace App\Api\Resource;

use App\Api\Resolver\ExpressionDataInjection;
use App\Api\Resolver\ExpressionDataInterface;

class SimulationOffre implements ExpressionDataInterface
{
    public ?int $id = null;
    public ?int $dispositif = null;
    public ?string $code = null;
    public ?string $nom = null;
    public ?string $description = null;
    public ?string $dateDebut = null;
    public ?string $dateFin = null;
    public ?bool $globale = null;
    public ?bool $multiple = null;
    public array $conditions = [];
    public array $valeurs = [];
    public array $exclusions = [];
    public ?SimulationAction $action = null;

    // Logique interne

    public function getDispositif(): ?SimulationDispositif
    {
        foreach ($this->action->simulation->dispositifs as $dispositif) {
            if ($dispositif->id === $this->dispositif) {
                return $dispositif;
            }
        }
        return null;
    }

    public function getAllConditions(): array
    {
        return \array_merge(
            $this->conditions,
            $this->getDispositif()->conditions
        );
    }

    public function getAllValeurs(): array
    {
        return \array_merge(
            \array_filter($this->valeurs, function(SimulationValeur $item) {
                return $item !== 'ecretement';
            }),
            \array_filter($this->getDispositif()->valeurs, function(SimulationValeur $item) {
                return $item !== 'ecretement';
            }),
            \array_filter($this->valeurs, function(SimulationValeur $item) {
                return $item === 'ecretement';
            }),
            \array_filter($this->getDispositif()->valeurs, function(SimulationValeur $item) {
                return $item === 'ecretement';
            })
        );
    }

    // Données intermédiaires

    public function getNbTravauxEligibles(): ?int
    {
        $count = 0;

        foreach ($this->action->simulation->actions as $action) {
            foreach ($action->getOffresEligibles() as $offre) {
                if ($offre->dispositif === $this->dispositif) {
                    $count++;
                    break;
                }
            }
        }
        return $count;
    }

    public function getPrimesCee(): ?float
    {
        return $this->action->getPrimesCee();
    }

    public function getPrimesTotal(): ?float
    {
        return $this->action->getPrimes();
    }

    public function getDepensesEligibles(): ?float
    {
        $depenses = $this->action->variables['$T.cout_ttc_total'] ?? null;

        foreach ($this->getAllValeurs() as $valeur) {
            if ($valeur->type === 'depenses' && $valeur->apply === true) {
                $depenses = \min($depenses, $valeur->getResponse());
            }
        }
        return $depenses;
    }

    // Data resolver

    public function getData(string $name): mixed
    {
        // Données d'entrée

        $variables = \array_merge(
            $this->action->simulation->variables,
            $this->action->variables
        );
        if (\array_key_exists($name, $variables)) {
            return $variables[$name];
        }

        // Variable intermédiaire

        if (\array_key_exists($name, ExpressionDataInjection::VARIABLES)) {
            $method = ExpressionDataInjection::VARIABLES[$name];

            if (\method_exists($this, $method)) {
                return $this->$method();
            }
        }

        // Défaut

        return null;
    }

    // Données de sortie

    public function isEligible(): ?bool
    {
        foreach ($this->getAllConditions() as $condition) {
            if ($condition->isValide() === false) {
                return false;
            }
        }
        // Offres globales
        if ($this->globale === true) {
            // Est éligible si une offre non gobale du même dispositif est éligible
            foreach ($this->action->offres as $offre) {
                if ($offre->dispositif === $this->dispositif && $offre->globale === false) {
                    return true;
                }
            }
            return false;
        }
        return true;
    }

    public function getMontant(): ?float
    {
        $montant = 0;

        // Application des montants
        foreach ($this->getAllValeurs() as $valeur) {
            if ($valeur->type === 'montant' && $valeur->apply()) {
                $montant = \max($montant, $valeur->getResponse());
            }
        }
        // Application des facteurs
        foreach ($this->getAllValeurs() as $valeur) {
            if ($valeur->type === 'facteur' && $valeur->apply()) {
                $montant *= $valeur->getResponse();
            }
        }
        // Application des planchers
        foreach ($this->getAllValeurs() as $valeur) {
            if ($valeur->type === 'planchers' && $valeur->apply()) {
                $montant = \max($montant, $valeur->getResponse());
            }
        }
        // Application des plafonds
        foreach ($this->getAllValeurs() as $valeur) {
            if ($valeur->type === 'plafonds' && $valeur->apply()) {
                $montant = \min($montant, $valeur->getResponse());
            }
        }

        return $montant;
    }

    public function getEcretement(): ?float
    {
        $valeurs = \array_filter($this->valeurs, function(SimulationValeur $item) {
            return $item->type === 'ecretement' && $item->apply();
        });
        $valeurs = \array_map(function(SimulationValeur $item) {
            return $item->getResponse();
        }, $valeurs);

        return \count($valeurs) > 0 ? \min($valeurs) : null;
    }

}
