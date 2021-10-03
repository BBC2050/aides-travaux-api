<?php

namespace App\Entity\Traits;

use Doctrine\Common\Collections\Collection;
use App\Entity\Valeur;

trait HasValeursTrait
{
    protected Collection $valeurs;

    public abstract function __construct();

    public function getValeurs(): array
    {
        return $this->valeurs->getValues();
    }

    public function getValeursCollection(): Collection
    {
        return $this->valeurs;
    }

    public function addValeur(Valeur $valeur): self
    {
        if (!$this->valeurs->contains($valeur)) {
            $this->valeurs[] = $valeur;
        }

        return $this;
    }

    public function removeValeur(Valeur $valeur): self
    {
        if ($this->valeurs->contains($valeur)) {
            $this->valeurs->removeElement($valeur);
        }

        return $this;
    }

}
