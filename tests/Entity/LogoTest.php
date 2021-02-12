<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Logo;

class LogoTest extends KernelTestCase
{
    public static function getEntity(): Logo
    {
        return (new Logo());
    }

    public function assertHasErrors(Logo $code, int $number = 0)
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

    public function testInvalidLogo()
    {
        $this->assertHasErrors(self::getEntity()->setFile(null), 1, ['create']);
    }
}
