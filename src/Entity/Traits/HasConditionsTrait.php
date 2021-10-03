<?php

namespace App\Entity\Traits;

use Doctrine\Common\Collections\Collection;
use App\Entity\Condition;

trait HasConditionsTrait
{
    protected Collection $conditions;

    public abstract function __construct();

    public function getConditions(): array
    {
        return $this->conditions->getValues();
    }

    public function getConditionsCollection(): Collection
    {
        return $this->conditions;
    }

    public function addCondition(Condition $condition): self
    {
        if (!$this->conditions->contains($condition)) {
            $this->conditions[] = $condition;
        }

        return $this;
    }

    public function removeCondition(Condition $condition): self
    {
        if ($this->conditions->contains($condition)) {
            $this->conditions->removeElement($condition);
        }

        return $this;
    }

    /**
     * Conditions satisfaites si l'ensemble des conditions le sont
     */
    public function isValide(): bool
    {
        foreach ($this->getConditionsCollection() as $condition) {
            if ($condition->isValide() === false) {
                return false;
            }
        }
        return true;
    }

}
