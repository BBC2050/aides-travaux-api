<?php

namespace App\Tests\Entity;

use App\Entity\OffreVariable;
use App\Entity\Offre;
use App\Entity\Variable;

class OffreVariableTest extends AbstractTest
{
    public function getEntity(): OffreVariable
    {
        return (new OffreVariable())
            ->setLabel('test')
            ->setVariable((new Variable()))
            ->setOffre((new Offre()));
    }

    public function testInvalidLabel(): void
    {
        $this->assertHasErrors($this->getEntity()->setLabel(null), 1);
        $this->assertHasErrors($this->getEntity()->setLabel(''), 1);
        $this->assertHasErrors($this->getEntity()->setLabel(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidVariable(): void
    {
        $this->assertHasErrors($this->getEntity()->setVariable(null), 1);
    }
    
    public function testInvalidOffre(): void
    {
        $this->assertHasErrors($this->getEntity()->setOffre(null), 1);
    }

}
