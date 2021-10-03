<?php

namespace App\Tests\Api\Resource;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;

abstract class AbstractTest extends KernelTestCase
{
    public abstract function getResource();

    public function assertHasErrors($resource, int $number = 0, $groups = [])
    {
        self::bootKernel();
        $errors = self::$container->get('validator')->validate($resource, null, $groups);
        $messages = [];
        /** @var ConstraintViolation $error */
        foreach($errors as $error) {
            $messages[] = $error->getPropertyPath() . ' => ' . $error->getMessage();
        }
        $number === 0
            ? $this->assertCount($number, $errors, implode(', ', $messages))
            : $this->assertGreaterThanOrEqual(1, \count($errors), implode(', ', $messages));
    }

    public function testValid(): void
    {
        $this->assertHasErrors($this->getResource(), 0);
    }
}
