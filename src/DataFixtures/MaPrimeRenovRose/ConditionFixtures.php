<?php

namespace App\DataFixtures\MaPrimeRenovRose;

abstract class ConditionFixtures
{
    /**
     * @var array
     */
    const PLAFONDS = [
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 1 && $REVENUS_FOYER > 38184',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 2 && $REVENUS_FOYER > 56130',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 3 && $REVENUS_FOYER > 67585',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 4 && $REVENUS_FOYER > 79041',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 5 && $REVENUS_FOYER > 90496',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER > 5 && $REVENUS_FOYER > (90496 + ($COMPOSITION_FOYER - 5) * 11455)',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 1 && $REVENUS_FOYER > 29148',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 2 && $REVENUS_FOYER > 42848',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 3 && $REVENUS_FOYER > 51592',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 4 && $REVENUS_FOYER > 60336',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 5 && $REVENUS_FOYER > 69081',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER > 5 && $REVENUS_FOYER > (69081 + ($COMPOSITION_FOYER - 5) * 8744)'
    ];

}
