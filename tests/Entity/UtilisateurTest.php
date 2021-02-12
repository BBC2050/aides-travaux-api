<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Utilisateur;

class UtilisateurTest extends KernelTestCase
{
    public static function getEntity(): Utilisateur
    {
        return (new Utilisateur())
            ->setEmail('johndoe@test.com')
            ->setRoles([])
            ->setPlainPassword('motdepassedetest');
    }

    public function assertHasErrors(Utilisateur $code, int $number = 0)
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

    public function testInvalidEmail()
    {
        $this->assertHasErrors(self::getEntity()->setEmail(null), 1);
        $this->assertHasErrors(self::getEntity()->setEmail(''), 1);
        $this->assertHasErrors(self::getEntity()->setEmail('error'), 1);
    }

    public function testInvalidPlainPassword()
    {
        $this->assertHasErrors(self::getEntity()->setPlainPassword('123456'), 1);
    }

}
