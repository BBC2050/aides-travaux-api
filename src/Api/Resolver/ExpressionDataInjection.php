<?php

namespace App\Api\Resolver;

abstract class ExpressionDataInjection
{
    const VARIABLES = [
        '$I.nb_travaux_eligibles' => 'getNbTravauxEligibles',
        '$I.prime_cee' => 'getPrimesCee',
        '$I.prime_total' => 'getPrimesTotal',
        '$I.depenses_eligibles' => 'getDepensesEligibles',
    ];

}
