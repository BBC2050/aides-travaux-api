<?php

namespace App\Tests\Entity;

use App\Entity\Expression;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Valeur;

class ValeurTest extends KernelTestCase
{
    public static function getEntity(): Valeur
    {
        return (new Valeur())
            ->setDescription('Description')
            ->setType('montant')
            ->setExpression((new Expression())->setExpression('2000'));
    }

    public function assertHasErrors(Valeur $code, int $number = 0)
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

    public function testInvalidType()
    {
        $this->assertHasErrors(self::getEntity()->setType(null), 1);
        $this->assertHasErrors(self::getEntity()->setType('invalid'), 1);
    }

    public function testInvalidExpression()
    {
        $this->assertHasErrors(self::getEntity()->setExpression(null), 1);
    }

}
