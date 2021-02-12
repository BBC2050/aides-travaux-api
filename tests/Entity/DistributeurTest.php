<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Distributeur;

class DistributeurTest extends KernelTestCase
{
    public static function getEntity(): Distributeur
    {
        return (new Distributeur())
            ->setNom('Nom')
            ->setPerimetre('FR');
    }

    public function assertHasErrors(Distributeur $code, int $number = 0)
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

    public function testInvalidNom()
    {
        $this->assertHasErrors(self::getEntity()->setNom(null), 1);
        $this->assertHasErrors(self::getEntity()->setNom(''), 1);
    }

    public function testInvalidPerimetre()
    {
        $this->assertHasErrors(self::getEntity()->setPerimetre(null), 1);
        $this->assertHasErrors(self::getEntity()->setPerimetre(''), 1);
    }

}
