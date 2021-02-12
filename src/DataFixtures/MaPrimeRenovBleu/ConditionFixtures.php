<?php

namespace App\DataFixtures\MaPrimeRenovBleu;

abstract class ConditionFixtures
{
    /**
     * @var array
     */
    const MA_PRIME_RENOV_BLEU_PLAFONDS = [
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 1 && $REVENUS_FOYER <= 20593',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 2 && $REVENUS_FOYER <= 30225',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 3 && $REVENUS_FOYER <= 36297',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 4 && $REVENUS_FOYER <= 42381',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER = 5 && $REVENUS_FOYER <= 48488',
        '$CODE_REGION = "11" && $COMPOSITION_FOYER > 5 && $REVENUS_FOYER <= (48488 + ($COMPOSITION_FOYER - 5) * 6096)',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 1 && $REVENUS_FOYER <= 14879',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 2 && $REVENUS_FOYER <= 21760',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 3 && $REVENUS_FOYER <= 26170',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 4 && $REVENUS_FOYER <= 30572',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER = 5 && $REVENUS_FOYER <= 34993',
        '$CODE_REGION <> "11" && $COMPOSITION_FOYER > 5 && $REVENUS_FOYER <= (34993 + ($COMPOSITION_FOYER - 5) * 4412)'
    ];
}
