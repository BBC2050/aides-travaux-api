<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Ouvrage;
use App\Entity\OuvrageCategorie;

class OuvrageTest extends KernelTestCase
{
    public static function getEntity(): Ouvrage
    {
        return (new Ouvrage())
            ->setCode('CODE')
            ->setNom('Nom')
            ->setCategorie((new OuvrageCategorie()));
    }

    public function assertHasErrors(Ouvrage $code, int $number = 0)
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

    public function testInvalidCode()
    {
        $this->assertHasErrors(self::getEntity()->setCode(null), 1);
        $this->assertHasErrors(self::getEntity()->setCode(''), 1);
    }

    public function testInvalidNom()
    {
        $this->assertHasErrors(self::getEntity()->setNom(null), 1);
        $this->assertHasErrors(self::getEntity()->setNom(''), 1);
    }

    public function testInvalidCategorie()
    {
        $this->assertHasErrors(self::getEntity()->setCategorie(null), 1);
    }

}
