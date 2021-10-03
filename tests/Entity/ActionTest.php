<?php

namespace App\Tests\Entity;

use App\Entity\Action;
use App\Entity\ActionCategorie;

class ActionTest extends AbstractTest
{
    public function getEntity(): Action
    {
        return (new Action())
            ->setCode('CODE')
            ->setNom('Nom')
            ->setCategorie((new ActionCategorie()));
    }

    public function testInvalidCode(): void
    {
        $this->assertHasErrors($this->getEntity()->setCode(null), 1);
        $this->assertHasErrors($this->getEntity()->setCode(''), 1);
        $this->assertHasErrors($this->getEntity()->setCode(\bin2hex(\random_bytes(21))), 1);
    }

    public function testInvalidNom(): void
    {
        $this->assertHasErrors($this->getEntity()->setNom(null), 1);
        $this->assertHasErrors($this->getEntity()->setNom(''), 1);
        $this->assertHasErrors($this->getEntity()->setNom(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidCategorie(): void
    {
        $this->assertHasErrors($this->getEntity()->setCategorie(null), 1);
    }

}
