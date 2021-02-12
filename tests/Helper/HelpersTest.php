<?php

namespace App\Tests\Helper;

use PHPUnit\Framework\TestCase;
use App\Helper\Helpers;

class HelpersTest extends TestCase
{
    public function getMock()
    {
        return $this->getObjectForTrait(Helpers::class);
    }

    public function testIsFranceMetropolitaineEmptyData()
    {
        $this->assertEquals(null, $this->getMock()->isFranceMetropolitaine([]));
    }

    public function testIsFranceMetropolitaine()
    {
        $this->assertEquals(true, $this->getMock()->isFranceMetropolitaine(['CODE_REGION' => '01']));
        $this->assertEquals(false, $this->getMock()->isFranceMetropolitaine(['CODE_REGION' => '974']));
    }

    public function testGetZoneClimatiqueEmptyData()
    {
        $this->assertEquals(null, $this->getMock()->getZoneClimatique([]));
    }

    public function testGetZoneClimatique()
    {
        $this->assertNotNull($this->getMock()->getZoneClimatique(['CODE_DEPARTEMENT' => '01']));
    }


}
