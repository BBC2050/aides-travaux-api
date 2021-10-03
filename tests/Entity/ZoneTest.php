<?php

namespace App\Tests\Entity;

use App\Entity\Dispositif;
use App\Entity\Zone;

class ZoneTest extends AbstractTest
{
    public function getEntity(): Zone
    {
        return (new Zone())->setCode('01')->setDispositif((new Dispositif()));
    }

    public function testInvalidCode(): void
    {
        $this->assertHasErrors($this->getEntity()->setCode(null), 1);
        $this->assertHasErrors($this->getEntity()->setCode(''), 1);
        $this->assertHasErrors($this->getEntity()->setCode('invalid'), 1);
    }

    public function testIsInvalide(): void
    {
        $this->assertHasErrors($this->getEntity()->setDispositif(null), 1);
    }

}
