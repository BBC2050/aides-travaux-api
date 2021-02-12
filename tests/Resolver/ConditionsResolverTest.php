<?php

namespace App\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Condition;
use App\Entity\Expression;
use App\Entity\Simulation;
use App\Resolver\ConditionsResolver;
use App\Resolver\ExpressionResolver;
use Doctrine\Common\Collections\Collection;

class ConditionsResolverTest extends TestCase
{
    public function resolve(Collection $conditions)
    {
        foreach ($conditions as $condition) {
            foreach ($condition->getExpressions() as $expression) {
                ExpressionResolver::resolve($expression, (new Simulation()));
            }
        }
    }

    public function testOneTrue()
    {
        $conditions = new ArrayCollection();

        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('true'))
        );

        $this->resolve($conditions);

        $this->assertEquals(true, ConditionsResolver::isEligible($conditions));
    }

    public function testOneFalse()
    {
        $conditions = new ArrayCollection();

        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('false'))
        );

        $this->resolve($conditions);

        $this->assertEquals(false, ConditionsResolver::isEligible($conditions));
    }

    public function testOneOfThemeFalse()
    {
        $conditions = new ArrayCollection();

        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('true'))
        );
        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('false'))
        );

        $this->resolve($conditions);

        $this->assertEquals(false, ConditionsResolver::isEligible($conditions));
    }

    public function testAllFalse()
    {
        $conditions = new ArrayCollection();

        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('false'))
        );
        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('false'))
        );

        $this->resolve($conditions);

        $this->assertEquals(false, ConditionsResolver::isEligible($conditions));
    }

    public function testMultipleTrue()
    {
        $conditions = new ArrayCollection();

        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('false'))
            ->addExpression((new Expression())->setExpression('true'))
        );

        $this->resolve($conditions);

        $this->assertEquals(true, ConditionsResolver::isEligible($conditions));
    }

    public function testMultipleFalse()
    {
        $conditions = new ArrayCollection();

        $conditions->add((new Condition())
            ->addExpression((new Expression())->setExpression('false'))
            ->addExpression((new Expression())->setExpression('false'))
        );

        $this->resolve($conditions);

        $this->assertEquals(false, ConditionsResolver::isEligible($conditions));
    }
}
