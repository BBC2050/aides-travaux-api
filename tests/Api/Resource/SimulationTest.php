<?php

namespace App\Tests\Api\Resource;

use App\Api\Resource\Simulation;
use App\Api\Resource\SimulationAction;
use App\Entity\Action;
use Doctrine\Common\Collections\ArrayCollection;

class SimulationTest extends AbstractTest
{
    public function getResource(): Simulation
    {
        $resource = new Simulation();        
        $action = new SimulationAction();
        $action->action = new Action();

        $resource->actions[] = $action;

        return $resource;
    }

    public function testInvalidActions(): void
    {
        $resource = $this->getResource();

        $resource->actions = new ArrayCollection();
        $this->assertHasErrors($resource, 1);
        $resource->actions[] = new SimulationAction();
        $this->assertHasErrors($resource, 1);
    }

    public function testInvalidVariables(): void
    {
        $resource = $this->getResource();

        $resource->variables = null;
        $this->assertHasErrors($resource, 1);
    }
}
