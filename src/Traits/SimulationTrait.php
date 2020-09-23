<?php

namespace App\Traits;

use Doctrine\Common\Collections\Collection;
use App\Model\Ouvrage;
use App\Utils\HelperCategorieRessource;
use App\Utils\HelperZoneClimatique;

trait SimulationTrait
{
    /**
     * Catégorie de ressource de l'Agence nationale de l'habitat
     */
    public function getCodeCategorieRessource(): ?string
    {
        return HelperCategorieRessource::get(
            $this->getRevenusFoyer(),
            $this->getCompositionFoyer(),
            $this->getCodeRegion()
        );
    }

    /**
     * Zone climatique du logement
     */
    public function getCodeZoneClimatique(): ?string
    {
        return HelperZoneClimatique::get($this->getCodeDepartement());
    }

    /**
     * Retourne le cout total des ouvrages 
     */
    public function getCoutTotalTTC(?string $codeAide): float
    {
        $ouvrages = $codeAide ? $this->getOuvragesEligibles($codeAide) : $this->getOuvrages();
        $sum = 0;

        foreach ($ouvrages as $ouvrage) {
            $sum += $ouvrage->getCoutTTC();
        }
        return (float) $sum;
    }

    /**
     * Retourne les ouvrages éligibles à l'aide en paramètre
     */
    public function getOuvragesEligibles(string $codeAide): Collection
    {
        return $this->ouvrages->filter(function(Ouvrage $ouvrage) use ($codeAide) {
            return $ouvrage->isEligible($codeAide);
        });
    }

    /**
     * Retourne le nombre d'ouvrages éligibles à l'aide en paramètre
     */
    public function countOuvragesEligibles(string $codeAide): int
    {
        return $this->getOuvragesEligibles($codeAide)->count();
    }

}
