<?php

namespace App\Tests\Entity;

use App\Entity\Expression;

class ExpressionTest extends AbstractTest
{
    public function getEntity(): Expression
    {
        return (new Expression())->setExpression(1);
    }

    public function testInvalidExpression(): void
    {
        $this->assertHasErrors($this->getEntity()->setExpression('invalid'), 1);
        $this->assertHasErrors($this->getEntity()->setExpression('$INVALID > 50'), 1);
        $this->assertHasErrors($this->getEntity()->setExpression('(2 + 1) * $VARIABLE_1 invalid 5'), 1);
    }

    public function testValidExpression(): void
    {
        $this->assertHasErrors($this->getEntity()->setExpression('$T.ma_variable > 50'), 0);
    }

}
