<?php

namespace App\Resolver;

use Doctrine\Common\Collections\Collection;
use App\Entity\Valeur;

abstract class ValeurResolver
{
    /**
     * @param float
     * @param Collection|Valeur[]
     */
    public static function get(float $base, Collection $valeurs): float
    {
        $montant = $base;
        $montant = self::applyFacteurs($montant, $valeurs);
        $montant = self::applyTermes($montant, $valeurs);
        $montant = self::applyPlafonds($montant, $valeurs);

        return $montant;
    }

    /**
     * @param float
     * @param Collection|Valeur[]
     */
    public static function applyFacteurs(float $base, Collection $valeurs): float
    {
        $facteurs = $valeurs
            ->filter(function($valeur) {
                return $valeur->getType() === 'facteur';
            })
            ->filter(function($valeur) {
                return ConditionsResolver::isEligible($valeur->getConditions());
            })
            ->map(function($valeur) {
                return $valeur->getExpression()->getResponse();
            })
            ->getValues();

        foreach ($facteurs as $facteur) {
            $base *= $facteur;
        }
        return (float) $base;
    }

    /**
     * @param float
     * @param Collection|Valeur[]
     */
    public static function applyTermes(float $base, Collection $valeurs): float
    {
        $termes = $valeurs
            ->filter(function($valeur) {
                return $valeur->getType() === 'terme';
            })
            ->filter(function($valeur) {
                return ConditionsResolver::isEligible($valeur->getConditions());
            })
            ->map(function($valeur) {
                return $valeur->getExpression()->getResponse();
            })
            ->getValues();

        foreach ($termes as $terme) {
            $base += $terme;
        }
        return (float) $base;
    }

    /**
     * @param float
     * @param Collection|Valeur[]
     */
    public static function applyPlafonds(float $base, Collection $valeurs): float
    {
        $plafonds = $valeurs
            ->filter(function($valeur) {
                return $valeur->getType() === 'plafond';
            })
            ->filter(function($valeur) {
                return ConditionsResolver::isEligible($valeur->getConditions());
            })
            ->map(function($valeur) {
                return $valeur->getExpression()->getResponse();
            })
            ->getValues();

        $plafonds[] = $base;

        return $plafonds ? \min($plafonds) : $base;
    }

}
