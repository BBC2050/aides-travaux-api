<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\OuvrageCategorie;

class OuvrageCategorieTest extends KernelTestCase
{
    public static function getEntity(): OuvrageCategorie
    {
        return (new OuvrageCategorie())->setNom('Nom');
    }

    public function assertHasErrors(OuvrageCategorie $code, int $number = 0)
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

}
