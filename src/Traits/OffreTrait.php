<?php

namespace App\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Model\Ouvrage as Simulation;

trait OffreTrait
{
    public function getSimulation(): ?Simulation
    {
        return $this->ouvrage->getSimulation();
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getPlafond(): ?float
    {
        // Plafonds spécifiques à l'offre
        $plafonds = $this->valeurs
            ->filter(function($valeur) {
                return $valeur->isEligible() && $valeur->getType() === 'plafond';
            })
            ->map(function($valeur) {
                return $valeur->getResponse();
            })
            ->getValues();

        // Plafonds de l'aide
        $plafonds[] = $this->aide->getPlafond();

        return \min($plafonds);
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function getMontant(): ?float
    {
        /** @var Valeur|null */
        $montant = $this->valeurs->filter(function($valeur) {
            return $valeur->isEligible() && $valeur->getType() === 'montant';
        })->first();

        /** @var Collection */
        $operations = $this->valeurs->filter(function($valeur) {
            return $valeur->isEligible() && \in_array($valeur->getType(), ['terme', 'facteur']);
        });

        /** @var float Montant de base /** */
        $base = $montant ? (float) $montant->getResponse() : (float) 0;

        // Opérations
        foreach ($operations as $operation) {
            switch ($operation->getType()) {
                case 'facteur':
                    $base *= (float) $operation->getResponse();
                    break;
                case 'terme':
                    $base += (float) $operation->getResponse();
                    break;
            }
        }

        return min($this->getPlafond(), $base);
    }
}
