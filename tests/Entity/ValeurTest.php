<?php

namespace App\Tests\Entity;

use App\Entity\Expression;
use App\Entity\Valeur;

class ValeurTest extends AbstractTest
{
    public function getEntity(): Valeur
    {
        return (new Valeur())
            ->setDescription('Description')
            ->setType('montant')
            ->setExpression(new Expression());
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

    public function testInvalidCondition(): void
    {
        $this->assertHasErrors($this->getEntity()->setCondition((new Expression())->setExpression('invalid')), 1);
    }

    public function testInvalidExpression(): void
    {
        $this->assertHasErrors($this->getEntity()->setExpression((new Expression())->setExpression('invalid')), 1);
    }

}
