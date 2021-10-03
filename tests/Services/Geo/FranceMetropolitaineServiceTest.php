<?php

namespace App\Tests\Services\Geo;

use PHPUnit\Framework\TestCase;
use App\Services\Geo\FranceMetropolitaineService;

class FranceMetropolitaineServiceTest extends TestCase
{
    /**
     * @dataProvider provideData
     */
    public function testGet(?string $codeRegion, bool $expect): void
    {
        $this->assertEquals(FranceMetropolitaineService::get($codeRegion), $expect);
    }

    public function provideData(): array
    {
        $data = [[ null, false ], [ 'invalid', false ]];

        foreach (FranceMetropolitaineService::CODES_REGIONS as $codeRegion) {
            $data[] = [ $codeRegion, true ];
        }
        return $data;
    }

}
