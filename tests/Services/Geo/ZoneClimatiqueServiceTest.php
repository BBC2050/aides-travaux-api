<?php

namespace App\Tests\Services\Geo;

use PHPUnit\Framework\TestCase;
use App\Services\Geo\ZoneClimatiqueService;

class ZoneClimatiqueServiceTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testGetCodeZoneClimatique(string $departement, string $expect): void
    {
        $this->assertEquals(ZoneClimatiqueService::get($departement), $expect);
    }

    public function provideData(): array
    {
        $data = [];

        foreach (ZoneClimatiqueService::ZONES_CLIMATIQUES as $zone => $departements) {
            foreach ($departements as $departement) {
                $data[] = [ $departement, $zone ];
            }
        }

        return $data;
    }

}
