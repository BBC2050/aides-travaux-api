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
        foreach ($this->conditions as $condition) {
            if ($condition->getResponse() === false) {
                return false;
            }
            continue;
        }
        return true;
    }
}
