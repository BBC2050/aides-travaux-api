<?php

namespace App\Tests\Api\Resource;

use App\Api\Resource\SimulationAction;
use App\Entity\Action;

class SimulationActionTest extends AbstractTest
{
    public function getResource(): SimulationAction
    {
        $resource = new SimulationAction();        
        $resource->action = new Action();

        return $resource;
    }

    public function testInvalidAction(): void
    {
        $resource = $this->getResource();

        $resource->action = null;
        $this->assertHasErrors($resource, 1);
    }

    public function testInvalidVariables(): void
    {
        $resource = $this->getResource();

        $resource->variables = null;
        $this->assertHasErrors($resource, 1);
    }

}
