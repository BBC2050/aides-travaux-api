<?php

namespace App\Tests\Utils;

use PHPUnit\Framework\TestCase;
use App\Utils\HelperZoneClimatique;

class HelperZoneClimatiqueTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testGet(string $departement, string $expect)
    {
        $this->assertEquals(HelperZoneClimatique::get($departement), $expect);
    }

    public function provideData(): array
    {
        $data = [];

        foreach (HelperZoneClimatique::ZONES_CLIMATIQUES as $zone => $departements) {
            foreach ($departements as $departement) {
                $data[] = [ $departement, $zone ];
            }
        }

        return $data;
    }
}
