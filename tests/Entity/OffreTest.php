<?php

namespace App\Tests\Entity;

use App\Entity\Offre;
use App\Entity\Dispositif;
use App\Entity\Condition;
use App\Entity\OffreVariable;
use App\Entity\Valeur;
use App\Entity\Variable;
use App\Entity\Zone;

class OffreTest extends AbstractTest
{
    public function getEntity(): Offre
    {
        return (new Offre())
            ->setCode('CODE')
            ->setNom('Nom')
            ->setDescription('Description')
            ->setDateDebut(new \DateTime('now'))
            ->setDispositif((new Dispositif()));
    }

    public function testInvalidCode(): void
    {
        $this->assertHasErrors($this->getEntity()->setCode(null), 1);
        $this->assertHasErrors($this->getEntity()->setCode(''), 1);
        $this->assertHasErrors($this->getEntity()->setCode(\bin2hex(\random_bytes(21))), 1);
    }

    public function testInvalidNom(): void
    {
        $this->assertHasErrors($this->getEntity()->setNom(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(null), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(\bin2hex(\random_bytes(1001))), 1);
    }

    public function testInvalidZones(): void
    {
        $this->assertHasErrors($this->getEntity()->addZone((new Zone())), 1);
    }

    public function testInvalidActive(): void
    {
        $this->assertHasErrors($this->getEntity()->setActive(null), 1);
    }

    public function testInvalidMultiple(): void
    {
        $this->assertHasErrors($this->getEntity()->setMultiple(null), 1);
    }

    public function testInvalidDateDebut(): void
    {
        $this->assertHasErrors($this->getEntity()->setDateDebut(null), 1);
    }
    
    public function testInvalidDispositif(): void
    {
        $this->assertHasErrors($this->getEntity()->setDispositif(null), 1);
    }

    public function testInvalidCondition(): void
    {
        $this->assertHasErrors($this->getEntity()->addCondition((new Condition())), 1);
    }

    public function testInvalidValeur(): void
    {
        $this->assertHasErrors($this->getEntity()->addValeur((new Valeur())), 1);
    }

    public function testInvalidVariable(): void
    {
        $this->assertHasErrors($this->getEntity()->addVariable((new OffreVariable())), 1);
        $this->assertHasErrors($this->getEntity()->addVariable(
            (new OffreVariable())
                ->setVariable((new Variable())->setCode('$T.ma_variable'))
                ->setLabel('Test')
        ), 1);
    }

}
