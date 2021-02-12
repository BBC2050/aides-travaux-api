<?php

namespace App\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Variable;
use App\Services\Assistant;

class ExpressionVariableExistsValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function validate($value, Constraint $constraint)
    {
        if ($value === null || $value === '') {
            return;
        }
        $name = \str_replace('$', '', $value);

        /** Si la valeur est une méthode interne */
        if (\array_key_exists($name, Assistant::HELPERS)) {
            return;
        }
        /** Recherche de la variable dans la base de données */
        $entity = $this->em->getRepository(Variable::class)->findOneBy(['nom' => $name]);

        if (!$entity) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}
