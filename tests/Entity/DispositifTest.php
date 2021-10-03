<?php

namespace App\Tests\Entity;

use App\Entity\Condition;
use App\Entity\Dispositif;
use App\Entity\Distributeur;
use App\Entity\Expression;
use App\Entity\Logo;
use App\Entity\Secteur;
use App\Entity\Valeur;
use App\Entity\Zone;

class DispositifTest extends AbstractTest
{
    public function getEntity(): Dispositif
    {
        return (new Dispositif())
            ->setCode('CODE')
            ->setNom('Nom')
            ->setDescription('Description')
            ->setType('prime')
            ->setDateDebut(new \DateTime('now'))
            ->setSecteur((new Secteur()))
            ->setDistributeur((new Distributeur()))
            ->setLogo((new Logo()));
    }

    public function testInvalidCode(): void
    {
        $this->assertHasErrors($this->getEntity()->setCode(null), 1);
        $this->assertHasErrors($this->getEntity()->setCode(''), 1);
        $this->assertHasErrors($this->getEntity()->setCode(\bin2hex(\random_bytes(21))), 1);
    }

    public function testInvalidNom(): void
    {
        $this->assertHasErrors($this->getEntity()->setNom(null), 1);
        $this->assertHasErrors($this->getEntity()->setNom(''), 1);
        $this->assertHasErrors($this->getEntity()->setNom(\bin2hex(\random_bytes(91))), 1);
    }

    public function testInvalidDescription(): void
    {
        $this->assertHasErrors($this->getEntity()->setDescription(null), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(''), 1);
        $this->assertHasErrors($this->getEntity()->setDescription(\bin2hex(\random_bytes(1001))), 1);
    }

    public function testInvalidType(): void
    {
        $this->assertHasErrors($this->getEntity()->setType(null), 1);
        $this->assertHasErrors($this->getEntity()->setType(''), 1);
        $this->assertHasErrors($this->getEntity()->setType('invalid'), 1);
    }

    public function testInvalidZones(): void
    {
        $this->assertHasErrors($this->getEntity()->addZone((new Zone())), 1);
    }

    public function testInvalidActive(): void
    {
        $this->assertHasErrors($this->getEntity()->setActive(null), 1);
    }

    public function testInvalidDateDebut(): void
    {
        $this->assertHasErrors($this->getEntity()->setDateDebut(null), 1);
    }
    
    public function testInvalidSecteur(): void
    {
        $this->assertHasErrors($this->getEntity()->setSecteur(null), 1);
    }
    
    public function testInvalidLogo(): void
    {
        $this->assertHasErrors($this->getEntity()->setLogo(null), 1);
    }
    
    public function testInvalidDistributeur(): void
    {
        $this->assertHasErrors($this->getEntity()->setDistributeur(null), 1);
    }

    public function testInvalidCondition(): void
    {
        $this->assertHasErrors($this->getEntity()->addCondition((new Condition())), 1);
    }

    public function testInvalidValeur(): void
    {
        $this->assertHasErrors($this->getEntity()->addValeur((new Valeur())), 1);
        $this->assertHasErrors($this->getEntity()->addValeur(
            (new Valeur())->setGlobale(true)->setExpression((new Expression())->setExpression('$T.ma_variable'))
        ), 1);
    }

}
