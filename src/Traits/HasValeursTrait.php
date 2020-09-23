<?php

namespace App\Traits;

use App\Utils\ExpressionLangageBuilder;

trait HasValeursTrait
{
    /**
     * Résolution des conditions de valeurs
     */
    public function resolveValeursConditions(): void
    {
        foreach ($this->valeurs as $valeur) {
            foreach ($valeur->getConditions() as $condition) {
                $response = ExpressionLangageBuilder::get()->evaluate(
                    $condition->getExpression(), [ 'object' => $this->getSimulation() ]
                );
                $condition->setResponse($response);
            }
        }
    }

    /**
     * Résolution des valeurs
     */
    public function resolveValeurs(): void
    {
        foreach ($this->valeurs as $valeur) {
            if ($valeur->isEligible()) {
                $response = ExpressionLangageBuilder::get()->evaluate(
                    $valeur->getValeur(), [ 'object' => $this->getSimulation() ]
                );
                $valeur->setResponse($response);
            }
        }
    }
}
