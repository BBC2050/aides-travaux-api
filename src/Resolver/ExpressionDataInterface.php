<?php

namespace App\Resolver;

interface ExpressionDataInterface
{
    public function getData(string $name): mixed;
}
