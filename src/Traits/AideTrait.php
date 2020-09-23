<?php

namespace App\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use App\Model\Simulation;

trait AideTrait
{
    /**
     * Retourne la simulation
     */
    public function getSimulation(): ?Simulation
    {
        return $this->simuation;
    }

    /**
     * Retourne le plafond de l'aide
     * @Groups({"simulation:item:read"})
     */
    public function getPlafond(): ?float
    {
        $plafonds = $this->valeurs
            ->filter(function($valeur) {
                return $valeur->isEligible() && $valeur->getType() === 'plafond';
            })
            ->map(function($valeur) {
                return $valeur->getResponse();
            })
            ->getValues();

        return $plafonds ? \min($plafonds) : null;
    }

    /**
     * Retourne le montant de l'offre
     * @Groups({"simulation:item:read"})
     */
    public function getMontant()
    {
        $montant = 0;
        $plafond = $this->getPlafond();

        foreach ($this->simulation->getOuvrages() as $ouvrage) {
            $offres = $ouvrage->getRessource()->getOffres()->filter(function($offre) {
                return $offre->isEligible() && $offre->getAide()->getId() === $this->getId();
            });

            foreach ($offres as $offre) {
                $montant += $offre->getMontant();
            }
        }
        return $plafond ? \min($plafond, $montant) : $montant;
    }
}
