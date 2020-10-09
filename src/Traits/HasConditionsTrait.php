<?php

namespace App\Traits;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

trait HasConditionsTrait
{
    /**
     * Résolution des conditions d'accès à l'aide
     */
    public function resolveConditions(): void
    {
        foreach ($this->conditions as $condition) {
            $response = (new ExpressionLanguage())->evaluate(
                $condition->getExpression(), [ 'object' => $this->getSimulation() ]
            );
            $condition->setResponse($response);
        }
    }

    /**
     * @Groups({"simulation:item:read"})
     */
    public function isEligible(): bool
    {
        $simpleConditions = $this->conditions->filter(function($condition) {
            return $condition->getGroupe() === null;
        });
        $groupedConditions = $this->conditions->filter(function($condition) {
            return $condition->getGroupe() !== null;
        });
        $groupes = [];

        /** Hydrate groupes */
        foreach ($groupedConditions as $condition) {
            if (!in_array($condition->getGroupe(), $groupes)) {
                $groupes[] = $condition->getGroupe();
            }
        }

        /** Parse simple conditions */
        foreach ($simpleConditions as $condition) {
            if ($condition->getResponse() === false) {
                return false;
            }
        }

        /** Parse grouped conditions */
        foreach ($groupes as $groupe) {
            $isEligible = false;
            $conditions = $groupedConditions->filter(function($condition) use ($groupe) {
                return $condition->getGroupe() === $groupe;
            });
            foreach ($conditions as $condition) {
                if ($condition->getResponse() === true) {
                    $isEligible = true;
                    break;
                }
            }
            if (!$isEligible) { return false; }
        }
        return true;
    }
}
