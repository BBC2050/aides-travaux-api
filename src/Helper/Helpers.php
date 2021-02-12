<?php

namespace App\Helper;

use App\Helper\HelperZoneClimatique;

trait Helpers
{
    public function isFranceMetropolitaine(): ?bool
    {
        if ($this->get('CODE_REGION')) {
            if (\in_array($this->get('CODE_REGION'), ['971', '972', '973', '974', '975'])) {
                return false;
            }
            return true;
        }
        return null;
    }

    public function getZoneClimatique(): ?string
    {
        return $this->get('CODE_DEPARTEMENT')
            ? HelperZoneClimatique::get($this->get('CODE_DEPARTEMENT'))
            : null;
    }

    public function getTravauxEligibles(): int
    {
        return $this->ouvrage->getSimulation()->getOuvragesEligibles($this->aide)->count();
    }

}
