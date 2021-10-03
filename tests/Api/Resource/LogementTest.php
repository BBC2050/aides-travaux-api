<?php

namespace App\Tests\Api\Resource;

use App\Api\Resource\Logement;

class LogementTest extends AbstractTest
{
    public function getResource(): Logement
    {
        $resource = new Logement();
        $resource->departement = '01';
        
        return $resource;
    }

    public function testInvalidDepartement(): void
    {
        $resource = $this->getResource();

        $resource->departement = null;
        $this->assertHasErrors($resource, 1);
        $resource->departement = '';
        $this->assertHasErrors($resource, 1);
        $resource->departement = 'invalid';
        $this->assertHasErrors($resource, 1);
    }

}
