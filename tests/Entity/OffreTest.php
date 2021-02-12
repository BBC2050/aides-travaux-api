<?php

namespace App\Tests\Entity;

use ReflectionClass;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Offre;
use App\Entity\Aide;
use App\Entity\Condition;
use App\Entity\Expression;
use App\Entity\Valeur;

class OffreTest extends KernelTestCase
{
    public function set($entity, $value, $propertyName = 'id')
    {
        $class = new ReflectionClass($entity);
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        $property->setValue($entity, $value);
    }

    public static function getEntity(): Offre
    {
        return (new Offre())
            ->setNom('Nom')
            ->setFiche('Fiche')
            ->setRessources([[ 'texte' => 'texte', 'url' => 'https://test.com' ]])
            ->setActive(true)
            ->setAide((new Aide()));
    }

    public function assertHasErrors(Offre $code, int $number = 0)
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

    public function testInvalidAide()
    {
        $this->assertHasErrors(self::getEntity()->setAide(null), 1);
    }

    public function testIsCumulable()
    {
        $offre = (new Offre())->setAide((new Aide()));

        for ($i=1; $i < 3; $i++) { 
            $aide = new Aide();
            $this->set($aide, $i);

            $offre->getAide()->addAideCumulable($aide);
        }

        $toCheck = (new Offre())->setAide((new Aide()));
        $this->set($toCheck->getAide(), 0);
        $this->assertFalse($offre->isCumulable($toCheck));

        $this->set($toCheck->getAide(), 1);
        $this->assertTrue($offre->isCumulable($toCheck));
    }

    public function testGetBase()
    {
        $offre = new Offre();
        $this->assertEquals(0, $offre->getBase());

        $offre->addValeur((new Valeur())->setType('montant')
            ->addCondition((new Condition())->addExpression((new Expression())->setResponse(false)))
            ->setExpression((new Expression())->setResponse(100)));
        $this->assertEquals(0, $offre->getBase());

        $offre->addValeur((new Valeur())->setType('montant')
            ->addCondition((new Condition())->addExpression((new Expression())->setResponse(true)))
            ->setExpression((new Expression())->setResponse(200)));
        $this->assertEquals(200, $offre->getBase());
        
        $offre->addValeur((new Valeur())->setType('montant')
            ->addCondition((new Condition())->addExpression((new Expression())->setResponse(true)))
            ->setExpression((new Expression())->setResponse(300)));
        $this->assertEquals(300, $offre->getBase());
    }

    public function testIsEligible()
    {
        $offre = (new Offre())->setAide(new Aide());
        $this->assertTrue($offre->isEligible());

        $offre->addCondition((new Condition())->addExpression((new Expression())->setResponse(true)));
        $offre->getAide()->addCondition((new Condition())->addExpression((new Expression())->setResponse(true)));
        $this->assertTrue($offre->isEligible());

        $offre->getAide()->addCondition((new Condition())->addExpression((new Expression())->setResponse(false)));
        $this->assertFalse($offre->isEligible());
    }

}
