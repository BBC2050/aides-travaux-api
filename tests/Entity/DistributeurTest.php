<?php

namespace App\Tests\Entity;

use App\Entity\Distributeur;

class DistributeurTest extends AbstractTest
{
    public function getEntity(): Distributeur
    {
        return (new Distributeur())
            ->setNom('Nom')
            ->setDescription('Distributeur');
    }

    public function testInvalidNom(): void
    {
        $this->assertHasErrors($this->getEntity()->setNom(null), 1);
        $this->assertHasErrors($this->getEntity()->setNom(''), 1);
        $this->assertHasErrors($this->getEntity()->setNom(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(null), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(\bin2hex(\random_bytes(1001))), 1);
    }

}
