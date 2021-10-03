<?php

namespace App\Api\Resolver;

use App\Resolver\ExpressionDataInterface as BaseInterface;

interface ExpressionDataInterface extends BaseInterface
{
    public function getNbTravauxEligibles(): ?int;
    public function getPrimesCee(): ?float;
    public function getPrimesTotal(): ?float;
    public function getDepensesEligibles(): ?float;
}
