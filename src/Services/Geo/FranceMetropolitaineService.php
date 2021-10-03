<?php

namespace App\Services\Geo;

abstract class FranceMetropolitaineService
{
    /**
     * Code ISO de la France métropolitaine
     */
    const CODE_ISO = '249';

    /**
     * Liste des codes des régions situées en France métropolitaine
     */
    const CODES_REGIONS = [
        '11', '24', '27', '28', '32', '44', '52', '53', '75', '76', '84', '93', '94'
    ];

    public static function get(?string $codeRegion): bool
    {
        return \in_array($codeRegion, self::CODES_REGIONS);
    }

}
