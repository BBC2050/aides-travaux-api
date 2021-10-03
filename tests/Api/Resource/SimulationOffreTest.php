<?php

namespace App\Tests\Api\Resource;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Api\Resource\Simulation;
use App\Api\Resource\SimulationAction;
use App\Api\Resource\SimulationOffre;
use App\Entity\Action;
use App\Entity\Offre;
use Doctrine\Common\Collections\ArrayCollection;

class SimulationOffreTest extends KernelTestCase
{
    public function testIsGlobale(): void
    {
        $offre = new SimulationOffre((new Offre()));
        $this->assertTrue($offre->isGlobale());

        $offre->actions = [1];
        $this->assertFalse($offre->isGlobale());
    }

}
