<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Aide;
use App\Entity\Distributeur;

class AideTest extends KernelTestCase
{
    public static function getEntity(): Aide
    {
        return (new Aide())
            ->setCode('CODE')
            ->setNom('Nom')
            ->setDescription('Description')
            ->setType('prime')
            ->setDelai('Délai')
            ->setRessources([[ 'texte' => 'texte', 'url' => 'https://test.com' ]])
            ->setDistributeur((new Distributeur()));
    }

    public function assertHasErrors(Aide $code, int $number = 0)
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

    public function testInvalidDelai()
    {
        $this->assertHasErrors(self::getEntity()->setDelai(null), 1);
    }

    public function testInvalidRessources()
    {
        $this->assertHasErrors(self::getEntity()->setRessources([[ 'texte' => 'texte' ]]), 1);
        $this->assertHasErrors(self::getEntity()->setRessources([[ 'url' => 'https://url.com' ]]), 1);
        $this->assertHasErrors(self::getEntity()->setRessources([[ 'texte' => null, 'url' => 'https://url.com' ]]), 1);
        $this->assertHasErrors(self::getEntity()->setRessources([[ 'texte' => 'texte', 'url' => 'invalid' ]]), 1);
    }

    public function testInvalidActive()
    {
        $this->assertHasErrors(self::getEntity()->setActive(null), 1);
    }

    public function testInvalidDistributeur()
    {
        $this->assertHasErrors(self::getEntity()->setDistributeur(null), 1);
    }

}
