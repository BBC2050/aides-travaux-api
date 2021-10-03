<?php

namespace App\Tests\Entity;

use App\Entity\Condition;
use App\Entity\Expression;

class ConditionTest extends AbstractTest
{
    public function getEntity(): Condition
    {
        return (new Condition())->setDescription('Description')->setExpression((new Expression()));
    }

    public function testInvalidDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(null), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(\bin2hex(\random_bytes(1001))), 1);
    }

    public function testExpressionInvalid(): void
    {
        $this->assertHasErrors($this->getEntity()->setExpression(null), 1);
    }

}
