<?php

namespace App\Tests\Entity;

use App\Entity\Variable;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\VariableOption;

class VariableOptionTest extends KernelTestCase
{
    public static function getEntity(): VariableOption
    {
        return (new VariableOption())
            ->setTexte('Texte')
            ->setValeur('Valeur')
            ->setVariable((new Variable()));
    }

    public function assertHasErrors(VariableOption $code, int $number = 0)
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

    public function testInvalidTexte()
    {
        $this->assertHasErrors(self::getEntity()->setTexte(null), 1);
        $this->assertHasErrors(self::getEntity()->setTexte(''), 1);
    }

    public function testInvalidValeur()
    {
        $this->assertHasErrors(self::getEntity()->setValeur(null), 1);
        $this->assertHasErrors(self::getEntity()->setValeur(''), 1);
    }

    public function testInvalidVariable()
    {
        $this->assertHasErrors(self::getEntity()->setVariable(null), 1);
    }

}
