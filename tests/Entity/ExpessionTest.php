<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Expression;

class ExpressionTest extends KernelTestCase
{
    public static function getEntity(): Expression
    {
        return (new Expression())->setExpression('$AGE_LOGEMENT > 50');
    }

    public function assertHasErrors(Expression $code, int $number = 0)
    {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($code);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $number === 0
            ? $this->assertCount($number, $errors, implode(', ', $messages))
            : $this->assertGreaterThanOrEqual(1, \count($errors), implode(', ', $messages));
    }

    public function testValidEntity()
    {
        $this->assertHasErrors(self::getEntity(), 0);
    }

    public function testInvalidExpression()
    {
        $this->assertHasErrors(self::getEntity()->setExpression('invalid'), 1);
        $this->assertHasErrors(self::getEntity()->setExpression('$INVALID > 50'), 1);
    }
    
    public function testValidExpression()
    {
        //$this->assertHasErrors(self::getEntity()->setExpression('(2 + 1) * $AGE_LOGEMENT'), 0);
        $this->assertHasErrors(self::getEntity()->setExpression('$AGE_LOGEMENT === "test" && ($AGE_LOGEMENT >= 10)'), 0);
    }

}
