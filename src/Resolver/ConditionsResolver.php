<?php

namespace App\Resolver;

use Doctrine\Common\Collections\Collection;
use App\Entity\Condition;

abstract class ConditionsResolver
{
    /**
     * @param Collection|Condition[]
     */
    public static function isEligible(Collection $conditions): bool
    {
        foreach ($conditions as $condition) {
            if ($condition instanceof Condition) {
                if (self::checkCondition($condition) === false) {
                    return false;
                }
            }
        }
        return true;
    }

    /**
     * @param Collection|Condition[]
     */
    public static function checkCondition(Condition $condition): bool
    {
        if ($condition->getExpressions()->count() === 0) {
            return true;
        }
        foreach ($condition->getExpressions() as $expression) {
            if ($expression->getResponse() === true) {
                return true;
            }
        }
        return false;
    }
}
