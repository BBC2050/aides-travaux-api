<?php

namespace App\Tests\Entity;

use App\Entity\Secteur;

class SecteurTest extends AbstractTest
{
    public function getEntity(): Secteur
    {
        return (new Secteur())
            ->setCode('CODE')
            ->setNom('Nom');
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

}
