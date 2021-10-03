<?php

namespace App\Tests\Entity;

use App\Entity\Variable;

class VariableTest extends AbstractTest
{
    public function getEntity(): Variable
    {
        return (new Variable())
            ->setCategorie('Categorie')
            ->setCode('$A.code')
            ->setDescription('Description')
            ->setType('string');
    }

    public function testInvalidCategorie(): void
    {
        $this->assertHasErrors($this->getEntity()->setCategorie(null), 1);
        $this->assertHasErrors($this->getEntity()->setCategorie(''), 1);
        $this->assertHasErrors($this->getEntity()->setCategorie(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidCode(): void
    {
        $this->assertHasErrors($this->getEntity()->setCode(null), 1);
        $this->assertHasErrors($this->getEntity()->setCode(''), 1);
        $this->assertHasErrors($this->getEntity()->setCode('invalid'), 1);
        $this->assertHasErrors($this->getEntity()->setCode(\bin2hex(\random_bytes(21))), 1);
    }

    public function testInvalidDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(null), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidType(): void
    {
        $this->assertHasErrors($this->getEntity()->setType(null), 1);
        $this->assertHasErrors($this->getEntity()->setType(''), 1);
        $this->assertHasErrors($this->getEntity()->setType('invalid'), 1);
    }

}
