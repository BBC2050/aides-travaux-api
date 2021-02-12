<?php

namespace App\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Expression;
use App\Entity\Valeur;
use App\Resolver\ValeurResolver;

class ValeurResolverTest extends TestCase
{
    public function testGet()
    {
        $valeurs = new ArrayCollection();
        $valeurs->add((new Valeur())->setType('facteur')->setExpression((new Expression())->setResponse('2')));
        $valeurs->add((new Valeur())->setType('facteur')->setExpression((new Expression())->setResponse('2')));
        $valeurs->add((new Valeur())->setType('terme')->setExpression((new Expression())->setResponse('10')));
        $valeurs->add((new Valeur())->setType('terme')->setExpression((new Expression())->setResponse('10')));
        $valeurs->add((new Valeur())->setType('plafond')->setExpression((new Expression())->setResponse('50')));

        $this->assertEquals(50, ValeurResolver::get(10, $valeurs));
    }

    public function testApplyFacteurs()
    {
        $valeurs = new ArrayCollection();
        $valeurs->add((new Valeur())->setType('facteur')->setExpression((new Expression())->setResponse('2')));
        $valeurs->add((new Valeur())->setType('facteur')->setExpression((new Expression())->setResponse('2')));

        $this->assertEquals(4, ValeurResolver::applyFacteurs(1, $valeurs));
    }

    public function testApplyTermes()
    {
        $valeurs = new ArrayCollection();
        $valeurs->add((new Valeur())->setType('terme')->setExpression((new Expression())->setResponse('2')));
        $valeurs->add((new Valeur())->setType('terme')->setExpression((new Expression())->setResponse('2')));

        $this->assertEquals(4, ValeurResolver::applyTermes(0, $valeurs));
    }

    public function testApplyPlafonds()
    {
        $valeurs = new ArrayCollection();
        $this->assertEquals(10, ValeurResolver::applyPlafonds(10, $valeurs));

        $valeurs->add((new Valeur())->setType('plafond')->setExpression((new Expression())->setResponse('10')));
        $valeurs->add((new Valeur())->setType('plafond')->setExpression((new Expression())->setResponse('5')));

        $this->assertEquals(5, ValeurResolver::applyPlafonds(20, $valeurs));
    }
}
