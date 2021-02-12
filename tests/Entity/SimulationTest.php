<?php

namespace App\Tests\Entity;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use App\Entity\Simulation;
use App\Entity\SimulationAide;
use App\Entity\SimulationOuvrage;
use App\Entity\Aide;
use App\Entity\Ouvrage;

class SimulationTest extends KernelTestCase
{
    public static function getEntity(): Simulation
    {
        return (new Simulation())
            ->addAide((new SimulationAide())->setAide((new Aide())))
            ->addOuvrage((new SimulationOuvrage())->setOuvrage((new Ouvrage())))
            ->setVariables([ 'MA_VARIABLE' => 2 ]);
    }

    public function assertHasErrors(Simulation $code, int $number = 0)
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

    public function testInvalidAide()
    {
        $aide = self::getEntity();
        $aide->getAides()->remove(0);
        $this->assertHasErrors($aide, 1);

        $this->assertHasErrors(self::getEntity()->addAide((new SimulationAide())), 1);
    }

    public function testInvalidOuvrage()
    {
        $aide = self::getEntity();
        $aide->getOuvrages()->remove(0);
        $this->assertHasErrors($aide, 1);

        $this->assertHasErrors(self::getEntity()->addOuvrage((new SimulationOuvrage())), 1);
    }

    public function testInvalidVariables()
    {
        $this->assertHasErrors(self::getEntity()->setVariables(null, 1));
        $this->assertHasErrors(self::getEntity()->setVariables([], 1));
    }

    public function testGetCoutTotal()
    {
        $simulation = (new Simulation())
            ->addOuvrage((new SimulationOuvrage())->setVariables(['COUT_TTC' => 1000]))
            ->addOuvrage((new SimulationOuvrage())->setVariables(['COUT_TTC' => 1000]));

        $this->assertEquals(2000, $simulation->getCoutTotal());
    }

}
