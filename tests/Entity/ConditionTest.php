<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Condition;
use App\Entity\Expression;

class ConditionTest extends KernelTestCase
{
    public static function getEntity(): Condition
    {
        return (new Condition())->setDescription('Description');
    }

    public function assertHasErrors(Condition $code, int $number = 0)
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

    public function testInvalidDescription()
    {
        $this->assertHasErrors(self::getEntity()->setDescription(null), 1);
        $this->assertHasErrors(self::getEntity()->setDescription(''), 1);
    }

    public function testIsValide()
    {
        $condition = new Condition();
        $this->assertNull($condition->isValide());

        $condition->addExpression((new Expression())->setResponse(false));
        $this->assertFalse($condition->isValide());
        
        $condition->addExpression((new Expression())->setResponse(true));
        $this->assertTrue($condition->isValide());
    }

}
