<?php

namespace App\Tests\Api\Resource;

use App\Api\Resource\Foyer;

class FoyerTest extends AbstractTest
{
    public function getResource(): Foyer
    {
        $resource = new Foyer();
        $resource->codeRegion = '01';
        $resource->composition = 2;
        $resource->revenus = 0;
        
        return $resource;
    }

    public function testInvalidCodeRegion(): void
    {
        $resource = $this->getResource();

        $resource->codeRegion = null;
        $this->assertHasErrors($resource, 1);
        $resource->codeRegion = '';
        $this->assertHasErrors($resource, 1);
        $resource->codeRegion = 'invalid';
        $this->assertHasErrors($resource, 1);
    }

    public function testInvalidComposition(): void
    {
        $resource = $this->getResource();

        $resource->composition = null;
        $this->assertHasErrors($resource, 1);
        $resource->composition = 0;
        $this->assertHasErrors($resource, 1);
    }

    public function testInvalidRevenus(): void
    {
        $resource = $this->getResource();

        $resource->revenus = null;
        $this->assertHasErrors($resource, 1);
        $resource->revenus = -1;
        $this->assertHasErrors($resource, 1);
    }

}
